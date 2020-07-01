<?php
namespace App\Repositories\Backend\Settings;

use App\Models\Settings\Setting;
// use App\Repositories\Backend\Settings\SettingsRepository;
use App\Repositories\BaseRepository;
use File;
/**
 * Class SettingsRepository.
 */

class SettingsRepository extends BaseRepository {
	/**
	 * Associated Repository Model.
	 */
	const MODEL = Setting::class ;
    protected $models;
    protected $settings_path;
	/**
	 * Constructor.
	 */
	public function __construct(Setting $models) {
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
	public function update(Setting $setting, array $input) {
        echo '<pre>';print_r($setting);
        echo "--------------------";
        echo '<pre>';print_r($input);
        echo ($this->settings_path);
        
		if (!empty($input['logo'])) {
			$this->removeLogo($setting, 'logo');

			$input['logo'] = $this->uploadLogo($input, 'logo');
		}

		if (!empty($input['favicon'])) {
			$this->removeLogo($setting, 'favicon');

			$input['favicon'] = $this->uploadLogo($setting, $input['favicon'], 'favicon');
		}
die("stop");
		if ($setting->update($input)) {
			return true;
		}

		throw new GeneralException(trans('exceptions.backend.settings.update_error'));
	}

	/*
	 * Upload logo image
	 */
	public function uploadLogo($input, $type) {
        // $path = $type == 'logo'?$this->site_logo_path:$this->favicon_path;
        $path = $this->settings_path;
        
        if(! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        if($type == "logo")
		$image_name = $type.time().$input['logo']->getClientOriginalName();

        $request->logo->move($path, $fileName);
		// $this->storage->put($path.$image_name, file_get_contents($logo->getRealPath()));
die($image_name);

		return $image_name;
    }
    
    public function removeLogo($setting, $logo){
        echo "remove logo";
    }
}