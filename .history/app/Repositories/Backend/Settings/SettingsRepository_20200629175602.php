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
    protected $site_logo_path;
	/**
	 * Constructor.
	 */
	public function __construct(Setting $models) {
        
        $this->models = $models;
        $this->site_logo_path = storage_path('images/settings');
        
        dd($this->site_logo_path);
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
        echo '<pre>';print_r($input);
        dd($this->site_logo_path);
        dd($input);
		if (!empty($input['logo'])) {
			$this->removeLogo($setting, 'logo');

			$input['logo'] = $this->uploadLogo($setting, $input['logo'], 'logo');
		}

		if (!empty($input['favicon'])) {
			$this->removeLogo($setting, 'favicon');

			$input['favicon'] = $this->uploadLogo($setting, $input['favicon'], 'favicon');
		}

		if ($setting->update($input)) {
			return true;
		}

		throw new GeneralException(trans('exceptions.backend.settings.update_error'));
	}

	/*
	 * Upload logo image
	 */
	public function uploadLogo($setting, $logo, $type) {
        $path = $type == 'logo'?$this->site_logo_path:$this->favicon_path;
        
        if(! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

		$image_name = time().$logo->getClientOriginalName();

		$this->storage->put($path.$image_name, file_get_contents($logo->getRealPath()));
die($image_name);

		return $image_name;
    }
    
    public function removeLogo($setting, $logo){

    }
}