<?php

namespace App\Repositories\Backend\Settings;

use App\Models\Settings\Setting;
// use App\Repositories\Backend\Settings\SettingsRepository;
use App\Repositories\BaseRepository;
use File;

/**
 * Class SettingsRepository.
 */

class SettingsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Setting::class;
    protected $models;
    protected $settings_path;
    /**
     * Constructor.
     */
    public function __construct(Setting $models)
    {
        $this->models = $models;
        $this->settings_path = storage_path('images/settings');
    }
    /**
     * @param \App\Models\Settings\Setting $setting
     * @param array                        $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function update(Setting $setting, array $input)
    {

        if (!empty($input['logo'])) {
            $this->removeLogo($input, 'site_logo');
            $input['logo'] = $this->uploadLogo($input, 'site_logo');
        }

        if (!empty($input['favicon'])) {
            $this->removeLogo($input, 'favicon');
            $input['favicon'] = $this->uploadLogo($input, 'favicon');
        }
        if ($setting->update($input)) {
            return true;
        }
    }

    /*
	 * Upload logo image
	 */
    public function uploadLogo($input, $type = "site_logo")
    {
        $path = $this->settings_path;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $image_name = $type . "_" . time();
        $uploaded = $input['logo']->move($path, $image_name);
        return $image_name;
    }

    public function removeLogo($setting, $logo)
    {
        echo "remove logo";
    }
}
