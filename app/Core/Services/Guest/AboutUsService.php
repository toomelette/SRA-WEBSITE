<?php
 
namespace App\Core\Services\Guest;

use App\Core\BaseClasses\BaseService;
use File;

class AboutUsService extends BaseService{



    public function viewServiceGuide($slug){

        $sg_list = [
            'dQU2Elbu2rwDPkTP' => 'STATICS/SERVICE-GUIDES/Admin-Accounting.pdf',
            'SanSH4jsBGlO5nvE' => 'STATICS/SERVICE-GUIDES/Admin-Budget-Treasury.pdf',
            'FwbAnovlU4kmhxsi' => 'STATICS/SERVICE-GUIDES/Admin-HRD.pdf',
            'G5O6i0I3TLzdmz8q' => 'STATICS/SERVICE-GUIDES/Admin-Library.pdf',
            'BpR5tsvuxEGaDsot' => 'STATICS/SERVICE-GUIDES/Admin-Records.pdf',
            'wKAAEvFxditJ147O' => 'STATICS/SERVICE-GUIDES/IAD.pdf',
            'TDW71ajKhHwBXqRR' => 'STATICS/SERVICE-GUIDES/Legal-Dept.pdf',
            'FqKX8qzrAXAe57DC' => 'STATICS/SERVICE-GUIDES/PPD-MIS.pdf',
            'vnl9HpgrR1GiQh1C' => 'STATICS/SERVICE-GUIDES/PPD-Planning.pdf',
            'OcDRZVp2qmhPGZEV' => 'STATICS/SERVICE-GUIDES/PPD-SPPME.pdf',
            'm4KlKNaBqtfdY0qb' => 'STATICS/SERVICE-GUIDES/RD-LMD-LuzMin.pdf',
            '74088fFY3FVR7J2s' => 'STATICS/SERVICE-GUIDES/RD-SRED-LuzMin.pdf',
            'sARophOruKscyiAa' => 'STATICS/SERVICE-GUIDES/RD-STD-LuzMin.pdf',
            'DunMB4pjYECxE5kp' => 'STATICS/SERVICE-GUIDES/RD-SRED-and-LMD-Visayas.pdf',
            '3UVx9GAh6qNk9OSz' => 'STATICS/SERVICE-GUIDES/RDE-LAREC.pdf',
            'weZkpnMv10nuXZmq' => 'STATICS/SERVICE-GUIDES/RDE-LuzMin.pdf',
            'Xtt3O3guarGNkppx' => 'STATICS/SERVICE-GUIDES/RDE-Visayas.pdf',
        ];

        if(array_key_exists($slug, $sg_list)) {
            $path = $this->__static->archive_dir() .'/'. $sg_list[$slug];
            if (!File::exists($path)){ return abort(404); }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

        return abort(404);

    }



    public function viewServiceFees(){

        $path = $this->__static->archive_dir() .'/STATICS/LIST-OF-FRONLINE-SERVICES.pdf';
        if (!File::exists($path)){ return abort(404); }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = response()->make($file, 200);
        $response->header("Content-Type", $type);
        return $response;

    }



}