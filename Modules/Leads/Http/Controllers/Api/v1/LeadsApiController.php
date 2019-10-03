<?php

namespace Modules\Leads\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Extras\Transformers\CallsResource;
use Modules\Leads\Entities\Lead;
use Modules\Leads\Events\LeadConverted;
use Modules\Leads\Http\Requests\LeadsRequest;
use Modules\Leads\Transformers\LeadResource;
use Modules\Leads\Transformers\LeadsResource;
use Modules\Todos\Transformers\TodosResource;

class LeadsApiController extends Controller {
    /**
     * Lead Model
     *
     * @var \Modules\Leads\Entities\Lead
     */
    protected $lead;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;


    public function __construct(Request $request) {
        $this->middleware('localize');
        $this->request = $request;
        $this->lead = new Lead;
    }


    /**
     * Get time zone
     * @param string $country
     * @param string $region
     * @return string If the timezone is not found, returns null`
     */
    function get_time_zone($country, $region = null) {
        $timezone = null;
        switch ($country) {
            case "AD":
                $timezone = "Europe/Andorra";
                break;
            case "AE":
                $timezone = "Asia/Dubai";
                break;
            case "AF":
                $timezone = "Asia/Kabul";
                break;
            case "AG":
                $timezone = "America/Antigua";
                break;
            case "AI":
                $timezone = "America/Anguilla";
                break;
            case "AL":
                $timezone = "Europe/Tirane";
                break;
            case "AM":
                $timezone = "Asia/Yerevan";
                break;
            case "AN":
                $timezone = "America/Curacao";
                break;
            case "AO":
                $timezone = "Africa/Luanda";
                break;
            case "AQ":
                $timezone = "Antarctica/South_Pole";
                break;
            case "AR":
                switch ($region) {
                    case "01":
                        $timezone = "America/Argentina/Buenos_Aires";
                        break;
                    case "02":
                        $timezone = "America/Argentina/Catamarca";
                        break;
                    case "03":
                        $timezone = "America/Argentina/Tucuman";
                        break;
                    case "04":
                        $timezone = "America/Argentina/Rio_Gallegos";
                        break;
                    case "05":
                        $timezone = "America/Argentina/Cordoba";
                        break;
                    case "06":
                        $timezone = "America/Argentina/Tucuman";
                        break;
                    case "07":
                        $timezone = "America/Argentina/Buenos_Aires";
                        break;
                    case "08":
                        $timezone = "America/Argentina/Buenos_Aires";
                        break;
                    case "09":
                        $timezone = "America/Argentina/Tucuman";
                        break;
                    case "10":
                        $timezone = "America/Argentina/Jujuy";
                        break;
                    case "11":
                        $timezone = "America/Argentina/San_Luis";
                        break;
                    case "12":
                        $timezone = "America/Argentina/La_Rioja";
                        break;
                    case "13":
                        $timezone = "America/Argentina/Mendoza";
                        break;
                    case "14":
                        $timezone = "America/Argentina/Buenos_Aires";
                        break;
                    case "15":
                        $timezone = "America/Argentina/San_Luis";
                        break;
                    case "16":
                        $timezone = "America/Argentina/Buenos_Aires";
                        break;
                    case "17":
                        $timezone = "America/Argentina/Salta";
                        break;
                    case "18":
                        $timezone = "America/Argentina/San_Juan";
                        break;
                    case "19":
                        $timezone = "America/Argentina/San_Luis";
                        break;
                    case "20":
                        $timezone = "America/Argentina/Rio_Gallegos";
                        break;
                    case "21":
                        $timezone = "America/Argentina/Buenos_Aires";
                        break;
                    case "22":
                        $timezone = "America/Argentina/Catamarca";
                        break;
                    case "23":
                        $timezone = "America/Argentina/Ushuaia";
                        break;
                    case "24":
                        $timezone = "America/Argentina/Tucuman";
                        break;
                    default:
                        $timezone = "America/Argentina/Buenos_Aires";
                }
                break;
            case "AS":
                $timezone = "Pacific/Pago_Pago";
                break;
            case "AT":
                $timezone = "Europe/Vienna";
                break;
            case "AU":
                switch ($region) {
                    case "01":
                        $timezone = "Australia/Sydney";
                        break;
                    case "02":
                        $timezone = "Australia/Sydney";
                        break;
                    case "03":
                        $timezone = "Australia/Darwin";
                        break;
                    case "04":
                        $timezone = "Australia/Brisbane";
                        break;
                    case "05":
                        $timezone = "Australia/Adelaide";
                        break;
                    case "06":
                        $timezone = "Australia/Hobart";
                        break;
                    case "07":
                        $timezone = "Australia/Melbourne";
                        break;
                    case "08":
                        $timezone = "Australia/Perth";
                        break;
                    default:
                        $timezone = "Australia/Sydney";
                }
                break;
            case "AW":
                $timezone = "America/Aruba";
                break;
            case "AX":
                $timezone = "Europe/Mariehamn";
                break;
            case "AZ":
                $timezone = "Asia/Baku";
                break;
            case "BA":
                $timezone = "Europe/Sarajevo";
                break;
            case "BB":
                $timezone = "America/Barbados";
                break;
            case "BD":
                $timezone = "Asia/Dhaka";
                break;
            case "BE":
                $timezone = "Europe/Brussels";
                break;
            case "BF":
                $timezone = "Africa/Ouagadougou";
                break;
            case "BG":
                $timezone = "Europe/Sofia";
                break;
            case "BH":
                $timezone = "Asia/Bahrain";
                break;
            case "BI":
                $timezone = "Africa/Bujumbura";
                break;
            case "BJ":
                $timezone = "Africa/Porto-Novo";
                break;
            case "BL":
                $timezone = "America/St_Barthelemy";
                break;
            case "BM":
                $timezone = "Atlantic/Bermuda";
                break;
            case "BN":
                $timezone = "Asia/Brunei";
                break;
            case "BO":
                $timezone = "America/La_Paz";
                break;
            case "BQ":
                $timezone = "America/Curacao";
                break;
            case "BR":
                switch ($region) {
                    case "01":
                        $timezone = "America/Rio_Branco";
                        break;
                    case "02":
                        $timezone = "America/Maceio";
                        break;
                    case "03":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "04":
                        $timezone = "America/Manaus";
                        break;
                    case "05":
                        $timezone = "America/Bahia";
                        break;
                    case "06":
                        $timezone = "America/Fortaleza";
                        break;
                    case "07":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "08":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "11":
                        $timezone = "America/Campo_Grande";
                        break;
                    case "13":
                        $timezone = "America/Belem";
                        break;
                    case "14":
                        $timezone = "America/Cuiaba";
                        break;
                    case "15":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "16":
                        $timezone = "America/Belem";
                        break;
                    case "17":
                        $timezone = "America/Recife";
                        break;
                    case "18":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "20":
                        $timezone = "America/Fortaleza";
                        break;
                    case "21":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "22":
                        $timezone = "America/Recife";
                        break;
                    case "23":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "24":
                        $timezone = "America/Porto_Velho";
                        break;
                    case "25":
                        $timezone = "America/Boa_Vista";
                        break;
                    case "26":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "27":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "28":
                        $timezone = "America/Maceio";
                        break;
                    case "29":
                        $timezone = "America/Sao_Paulo";
                        break;
                    case "30":
                        $timezone = "America/Recife";
                        break;
                    case "31":
                        $timezone = "America/Araguaina";
                        break;
                    default:
                        $timezone = "America/Sao_Paulo";
                }
                break;
            case "BS":
                $timezone = "America/Nassau";
                break;
            case "BT":
                $timezone = "Asia/Thimphu";
                break;
            case "BV":
                $timezone = "Antarctica/Syowa";
                break;
            case "BW":
                $timezone = "Africa/Gaborone";
                break;
            case "BY":
                $timezone = "Europe/Minsk";
                break;
            case "BZ":
                $timezone = "America/Belize";
                break;
            case "CA":
                switch ($region) {
                    case "AB":
                        $timezone = "America/Edmonton";
                        break;
                    case "BC":
                        $timezone = "America/Vancouver";
                        break;
                    case "MB":
                        $timezone = "America/Winnipeg";
                        break;
                    case "NB":
                        $timezone = "America/Halifax";
                        break;
                    case "NL":
                        $timezone = "America/St_Johns";
                        break;
                    case "NS":
                        $timezone = "America/Halifax";
                        break;
                    case "NT":
                        $timezone = "America/Yellowknife";
                        break;
                    case "NU":
                        $timezone = "America/Rankin_Inlet";
                        break;
                    case "ON":
                        $timezone = "America/Toronto";
                        break;
                    case "PE":
                        $timezone = "America/Halifax";
                        break;
                    case "QC":
                        $timezone = "America/Montreal";
                        break;
                    case "SK":
                        $timezone = "America/Regina";
                        break;
                    case "YT":
                        $timezone = "America/Whitehorse";
                        break;
                    default:
                        $timezone = "America/Vancouver";
                }
                break;
            case "CC":
                $timezone = "Indian/Cocos";
                break;
            case "CD":
                switch ($region) {
                    case "01":
                        $timezone = "Africa/Kinshasa";
                        break;
                    case "02":
                        $timezone = "Africa/Kinshasa";
                        break;
                    case "03":
                        $timezone = "Africa/Kinshasa";
                        break;
                    case "04":
                        $timezone = "Africa/Lubumbashi";
                        break;
                    case "05":
                        $timezone = "Africa/Lubumbashi";
                        break;
                    case "06":
                        $timezone = "Africa/Kinshasa";
                        break;
                    case "07":
                        $timezone = "Africa/Lubumbashi";
                        break;
                    case "08":
                        $timezone = "Africa/Kinshasa";
                        break;
                    case "09":
                        $timezone = "Africa/Lubumbashi";
                        break;
                    case "10":
                        $timezone = "Africa/Lubumbashi";
                        break;
                    case "11":
                        $timezone = "Africa/Lubumbashi";
                        break;
                    case "12":
                        $timezone = "Africa/Lubumbashi";
                        break;
                    default:
                        $timezone = "Africa/Kinshasa";
                }
                break;
            case "CF":
                $timezone = "Africa/Bangui";
                break;
            case "CG":
                $timezone = "Africa/Brazzaville";
                break;
            case "CH":
                $timezone = "Europe/Zurich";
                break;
            case "CI":
                $timezone = "Africa/Abidjan";
                break;
            case "CK":
                $timezone = "Pacific/Rarotonga";
                break;
            case "CL":
                $timezone = "America/Santiago";
                break;
            case "CM":
                $timezone = "Africa/Lagos";
                break;
            case "CN":
                switch ($region) {
                    case "01":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "02":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "03":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "04":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "05":
                        $timezone = "Asia/Harbin";
                        break;
                    case "06":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "07":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "08":
                        $timezone = "Asia/Harbin";
                        break;
                    case "09":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "10":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "11":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "12":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "13":
                        $timezone = "Asia/Urumqi";
                        break;
                    case "14":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "15":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "16":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "18":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "19":
                        $timezone = "Asia/Harbin";
                        break;
                    case "20":
                        $timezone = "Asia/Harbin";
                        break;
                    case "21":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "22":
                        $timezone = "Asia/Harbin";
                        break;
                    case "23":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "24":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "25":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "26":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "28":
                        $timezone = "Asia/Shanghai";
                        break;
                    case "29":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "30":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "31":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "32":
                        $timezone = "Asia/Chongqing";
                        break;
                    case "33":
                        $timezone = "Asia/Chongqing";
                        break;
                    default:
                        $timezone = "Asia/Shanghai";
                }
                break;
            case "CO":
                $timezone = "America/Bogota";
                break;
            case "CR":
                $timezone = "America/Costa_Rica";
                break;
            case "CU":
                $timezone = "America/Havana";
                break;
            case "CV":
                $timezone = "Atlantic/Cape_Verde";
                break;
            case "CW":
                $timezone = "America/Curacao";
                break;
            case "CX":
                $timezone = "Indian/Christmas";
                break;
            case "CY":
                $timezone = "Asia/Nicosia";
                break;
            case "CZ":
                $timezone = "Europe/Prague";
                break;
            case "DE":
                $timezone = "Europe/Berlin";
                break;
            case "DJ":
                $timezone = "Africa/Djibouti";
                break;
            case "DK":
                $timezone = "Europe/Copenhagen";
                break;
            case "DM":
                $timezone = "America/Dominica";
                break;
            case "DO":
                $timezone = "America/Santo_Domingo";
                break;
            case "DZ":
                $timezone = "Africa/Algiers";
                break;
            case "EC":
                switch ($region) {
                    case "01":
                        $timezone = "Pacific/Galapagos";
                        break;
                    case "02":
                        $timezone = "America/Guayaquil";
                        break;
                    case "03":
                        $timezone = "America/Guayaquil";
                        break;
                    case "04":
                        $timezone = "America/Guayaquil";
                        break;
                    case "05":
                        $timezone = "America/Guayaquil";
                        break;
                    case "06":
                        $timezone = "America/Guayaquil";
                        break;
                    case "07":
                        $timezone = "America/Guayaquil";
                        break;
                    case "08":
                        $timezone = "America/Guayaquil";
                        break;
                    case "09":
                        $timezone = "America/Guayaquil";
                        break;
                    case "10":
                        $timezone = "America/Guayaquil";
                        break;
                    case "11":
                        $timezone = "America/Guayaquil";
                        break;
                    case "12":
                        $timezone = "America/Guayaquil";
                        break;
                    case "13":
                        $timezone = "America/Guayaquil";
                        break;
                    case "14":
                        $timezone = "America/Guayaquil";
                        break;
                    case "15":
                        $timezone = "America/Guayaquil";
                        break;
                    case "17":
                        $timezone = "America/Guayaquil";
                        break;
                    case "18":
                        $timezone = "America/Guayaquil";
                        break;
                    case "19":
                        $timezone = "America/Guayaquil";
                        break;
                    case "20":
                        $timezone = "America/Guayaquil";
                        break;
                    case "22":
                        $timezone = "America/Guayaquil";
                        break;
                    case "24":
                        $timezone = "America/Guayaquil";
                        break;
                    default:
                        $timezone = "Pacific/Galapagos";
                }
                break;
            case "EE":
                $timezone = "Europe/Tallinn";
                break;
            case "EG":
                $timezone = "Africa/Cairo";
                break;
            case "EH":
                $timezone = "Africa/El_Aaiun";
                break;
            case "ER":
                $timezone = "Africa/Asmara";
                break;
            case "ES":
                switch ($region) {
                    case "07":
                        $timezone = "Europe/Madrid";
                        break;
                    case "27":
                        $timezone = "Europe/Madrid";
                        break;
                    case "29":
                        $timezone = "Europe/Madrid";
                        break;
                    case "31":
                        $timezone = "Europe/Madrid";
                        break;
                    case "32":
                        $timezone = "Europe/Madrid";
                        break;
                    case "34":
                        $timezone = "Europe/Madrid";
                        break;
                    case "39":
                        $timezone = "Europe/Madrid";
                        break;
                    case "51":
                        $timezone = "Africa/Ceuta";
                        break;
                    case "52":
                        $timezone = "Europe/Madrid";
                        break;
                    case "53":
                        $timezone = "Atlantic/Canary";
                        break;
                    case "54":
                        $timezone = "Europe/Madrid";
                        break;
                    case "55":
                        $timezone = "Europe/Madrid";
                        break;
                    case "56":
                        $timezone = "Europe/Madrid";
                        break;
                    case "57":
                        $timezone = "Europe/Madrid";
                        break;
                    case "58":
                        $timezone = "Europe/Madrid";
                        break;
                    case "59":
                        $timezone = "Europe/Madrid";
                        break;
                    case "60":
                        $timezone = "Europe/Madrid";
                        break;
                    default:
                        $timezone = "Europe/Madrid";
                }
                break;
            case "ET":
                $timezone = "Africa/Addis_Ababa";
                break;
            case "FI":
                $timezone = "Europe/Helsinki";
                break;
            case "FJ":
                $timezone = "Pacific/Fiji";
                break;
            case "FK":
                $timezone = "Atlantic/Stanley";
                break;
            case "FM":
                $timezone = "Pacific/Pohnpei";
                break;
            case "FO":
                $timezone = "Atlantic/Faroe";
                break;
            case "FR":
                $timezone = "Europe/Paris";
                break;
            case "FX":
                $timezone = "Europe/Paris";
                break;
            case "GA":
                $timezone = "Africa/Libreville";
                break;
            case "GB":
                $timezone = "Europe/London";
                break;
            case "GD":
                $timezone = "America/Grenada";
                break;
            case "GE":
                $timezone = "Asia/Tbilisi";
                break;
            case "GF":
                $timezone = "America/Cayenne";
                break;
            case "GG":
                $timezone = "Europe/Guernsey";
                break;
            case "GH":
                $timezone = "Africa/Accra";
                break;
            case "GI":
                $timezone = "Europe/Gibraltar";
                break;
            case "GL":
                switch ($region) {
                    case "01":
                        $timezone = "America/Thule";
                        break;
                    case "02":
                        $timezone = "America/Godthab";
                        break;
                    case "03":
                        $timezone = "America/Godthab";
                        break;
                    default:
                        $timezone = "America/Thule";
                }
                break;
            case "GM":
                $timezone = "Africa/Banjul";
                break;
            case "GN":
                $timezone = "Africa/Conakry";
                break;
            case "GP":
                $timezone = "America/Guadeloupe";
                break;
            case "GQ":
                $timezone = "Africa/Malabo";
                break;
            case "GR":
                $timezone = "Europe/Athens";
                break;
            case "GS":
                $timezone = "Atlantic/South_Georgia";
                break;
            case "GT":
                $timezone = "America/Guatemala";
                break;
            case "GU":
                $timezone = "Pacific/Guam";
                break;
            case "GW":
                $timezone = "Africa/Bissau";
                break;
            case "GY":
                $timezone = "America/Guyana";
                break;
            case "HK":
                $timezone = "Asia/Hong_Kong";
                break;
            case "HN":
                $timezone = "America/Tegucigalpa";
                break;
            case "HR":
                $timezone = "Europe/Zagreb";
                break;
            case "HT":
                $timezone = "America/Port-au-Prince";
                break;
            case "HU":
                $timezone = "Europe/Budapest";
                break;
            case "ID":
                switch ($region) {
                    case "01":
                        $timezone = "Asia/Pontianak";
                        break;
                    case "02":
                        $timezone = "Asia/Makassar";
                        break;
                    case "03":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "04":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "05":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "06":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "07":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "08":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "09":
                        $timezone = "Asia/Jayapura";
                        break;
                    case "10":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "11":
                        $timezone = "Asia/Pontianak";
                        break;
                    case "12":
                        $timezone = "Asia/Makassar";
                        break;
                    case "13":
                        $timezone = "Asia/Makassar";
                        break;
                    case "14":
                        $timezone = "Asia/Makassar";
                        break;
                    case "15":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "16":
                        $timezone = "Asia/Makassar";
                        break;
                    case "17":
                        $timezone = "Asia/Makassar";
                        break;
                    case "18":
                        $timezone = "Asia/Makassar";
                        break;
                    case "19":
                        $timezone = "Asia/Pontianak";
                        break;
                    case "20":
                        $timezone = "Asia/Makassar";
                        break;
                    case "21":
                        $timezone = "Asia/Makassar";
                        break;
                    case "22":
                        $timezone = "Asia/Makassar";
                        break;
                    case "23":
                        $timezone = "Asia/Makassar";
                        break;
                    case "24":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "25":
                        $timezone = "Asia/Pontianak";
                        break;
                    case "26":
                        $timezone = "Asia/Pontianak";
                        break;
                    case "28":
                        $timezone = "Asia/Jayapura";
                        break;
                    case "29":
                        $timezone = "Asia/Makassar";
                        break;
                    case "30":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "31":
                        $timezone = "Asia/Makassar";
                        break;
                    case "32":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "33":
                        $timezone = "Asia/Jakarta";
                        break;
                    case "34":
                        $timezone = "Asia/Makassar";
                        break;
                    case "35":
                        $timezone = "Asia/Pontianak";
                        break;
                    case "36":
                        $timezone = "Asia/Jayapura";
                        break;
                    case "37":
                        $timezone = "Asia/Pontianak";
                        break;
                    case "38":
                        $timezone = "Asia/Makassar";
                        break;
                    case "39":
                        $timezone = "Asia/Jayapura";
                        break;
                    case "40":
                        $timezone = "Asia/Pontianak";
                        break;
                    case "41":
                        $timezone = "Asia/Makassar";
                        break;
                    default:
                        $timezone = "Asia/Jakarta";
                }
                break;
            case "IE":
                $timezone = "Europe/Dublin";
                break;
            case "IL":
                $timezone = "Asia/Jerusalem";
                break;
            case "IM":
                $timezone = "Europe/Isle_of_Man";
                break;
            case "IN":
                $timezone = "Asia/Kolkata";
                break;
            case "IO":
                $timezone = "Indian/Chagos";
                break;
            case "IQ":
                $timezone = "Asia/Baghdad";
                break;
            case "IR":
                $timezone = "Asia/Tehran";
                break;
            case "IS":
                $timezone = "Atlantic/Reykjavik";
                break;
            case "IT":
                $timezone = "Europe/Rome";
                break;
            case "JE":
                $timezone = "Europe/Jersey";
                break;
            case "JM":
                $timezone = "America/Jamaica";
                break;
            case "JO":
                $timezone = "Asia/Amman";
                break;
            case "JP":
                $timezone = "Asia/Tokyo";
                break;
            case "KE":
                $timezone = "Africa/Nairobi";
                break;
            case "KG":
                $timezone = "Asia/Bishkek";
                break;
            case "KH":
                $timezone = "Asia/Phnom_Penh";
                break;
            case "KI":
                $timezone = "Pacific/Tarawa";
                break;
            case "KM":
                $timezone = "Indian/Comoro";
                break;
            case "KN":
                $timezone = "America/St_Kitts";
                break;
            case "KP":
                $timezone = "Asia/Pyongyang";
                break;
            case "KR":
                $timezone = "Asia/Seoul";
                break;
            case "KW":
                $timezone = "Asia/Kuwait";
                break;
            case "KY":
                $timezone = "America/Cayman";
                break;
            case "KZ":
                switch ($region) {
                    case "01":
                        $timezone = "Asia/Almaty";
                        break;
                    case "02":
                        $timezone = "Asia/Almaty";
                        break;
                    case "03":
                        $timezone = "Asia/Qyzylorda";
                        break;
                    case "04":
                        $timezone = "Asia/Aqtobe";
                        break;
                    case "05":
                        $timezone = "Asia/Qyzylorda";
                        break;
                    case "06":
                        $timezone = "Asia/Aqtau";
                        break;
                    case "07":
                        $timezone = "Asia/Oral";
                        break;
                    case "08":
                        $timezone = "Asia/Qyzylorda";
                        break;
                    case "09":
                        $timezone = "Asia/Aqtau";
                        break;
                    case "10":
                        $timezone = "Asia/Qyzylorda";
                        break;
                    case "11":
                        $timezone = "Asia/Almaty";
                        break;
                    case "12":
                        $timezone = "Asia/Qyzylorda";
                        break;
                    case "13":
                        $timezone = "Asia/Aqtobe";
                        break;
                    case "14":
                        $timezone = "Asia/Qyzylorda";
                        break;
                    case "15":
                        $timezone = "Asia/Almaty";
                        break;
                    case "16":
                        $timezone = "Asia/Aqtobe";
                        break;
                    case "17":
                        $timezone = "Asia/Almaty";
                        break;
                    default:
                        $timezone = "Asia/Almaty";
                }
                break;
            case "LA":
                $timezone = "Asia/Vientiane";
                break;
            case "LB":
                $timezone = "Asia/Beirut";
                break;
            case "LC":
                $timezone = "America/St_Lucia";
                break;
            case "LI":
                $timezone = "Europe/Vaduz";
                break;
            case "LK":
                $timezone = "Asia/Colombo";
                break;
            case "LR":
                $timezone = "Africa/Monrovia";
                break;
            case "LS":
                $timezone = "Africa/Maseru";
                break;
            case "LT":
                $timezone = "Europe/Vilnius";
                break;
            case "LU":
                $timezone = "Europe/Luxembourg";
                break;
            case "LV":
                $timezone = "Europe/Riga";
                break;
            case "LY":
                $timezone = "Africa/Tripoli";
                break;
            case "MA":
                $timezone = "Africa/Casablanca";
                break;
            case "MC":
                $timezone = "Europe/Monaco";
                break;
            case "MD":
                $timezone = "Europe/Chisinau";
                break;
            case "ME":
                $timezone = "Europe/Podgorica";
                break;
            case "MF":
                $timezone = "America/Marigot";
                break;
            case "MG":
                $timezone = "Indian/Antananarivo";
                break;
            case "MH":
                $timezone = "Pacific/Kwajalein";
                break;
            case "MK":
                $timezone = "Europe/Skopje";
                break;
            case "ML":
                $timezone = "Africa/Bamako";
                break;
            case "MM":
                $timezone = "Asia/Rangoon";
                break;
            case "MN":
                switch ($region) {
                    case "06":
                        $timezone = "Asia/Choibalsan";
                        break;
                    case "11":
                        $timezone = "Asia/Ulaanbaatar";
                        break;
                    case "17":
                        $timezone = "Asia/Choibalsan";
                        break;
                    case "19":
                        $timezone = "Asia/Hovd";
                        break;
                    case "20":
                        $timezone = "Asia/Ulaanbaatar";
                        break;
                    case "21":
                        $timezone = "Asia/Ulaanbaatar";
                        break;
                    case "25":
                        $timezone = "Asia/Ulaanbaatar";
                        break;
                    default:
                        $timezone = "Asia/Ulaanbaatar";
                }
                break;
            case "MO":
                $timezone = "Asia/Macau";
                break;
            case "MP":
                $timezone = "Pacific/Saipan";
                break;
            case "MQ":
                $timezone = "America/Martinique";
                break;
            case "MR":
                $timezone = "Africa/Nouakchott";
                break;
            case "MS":
                $timezone = "America/Montserrat";
                break;
            case "MT":
                $timezone = "Europe/Malta";
                break;
            case "MU":
                $timezone = "Indian/Mauritius";
                break;
            case "MV":
                $timezone = "Indian/Maldives";
                break;
            case "MW":
                $timezone = "Africa/Blantyre";
                break;
            case "MX":
                switch ($region) {
                    case "01":
                        $timezone = "America/Mexico_City";
                        break;
                    case "02":
                        $timezone = "America/Tijuana";
                        break;
                    case "03":
                        $timezone = "America/Hermosillo";
                        break;
                    case "04":
                        $timezone = "America/Merida";
                        break;
                    case "05":
                        $timezone = "America/Mexico_City";
                        break;
                    case "06":
                        $timezone = "America/Chihuahua";
                        break;
                    case "07":
                        $timezone = "America/Monterrey";
                        break;
                    case "08":
                        $timezone = "America/Mexico_City";
                        break;
                    case "09":
                        $timezone = "America/Mexico_City";
                        break;
                    case "10":
                        $timezone = "America/Mazatlan";
                        break;
                    case "11":
                        $timezone = "America/Mexico_City";
                        break;
                    case "12":
                        $timezone = "America/Mexico_City";
                        break;
                    case "13":
                        $timezone = "America/Mexico_City";
                        break;
                    case "14":
                        $timezone = "America/Mazatlan";
                        break;
                    case "15":
                        $timezone = "America/Chihuahua";
                        break;
                    case "16":
                        $timezone = "America/Mexico_City";
                        break;
                    case "17":
                        $timezone = "America/Mexico_City";
                        break;
                    case "18":
                        $timezone = "America/Mazatlan";
                        break;
                    case "19":
                        $timezone = "America/Monterrey";
                        break;
                    case "20":
                        $timezone = "America/Mexico_City";
                        break;
                    case "21":
                        $timezone = "America/Mexico_City";
                        break;
                    case "22":
                        $timezone = "America/Mexico_City";
                        break;
                    case "23":
                        $timezone = "America/Cancun";
                        break;
                    case "24":
                        $timezone = "America/Mexico_City";
                        break;
                    case "25":
                        $timezone = "America/Mazatlan";
                        break;
                    case "26":
                        $timezone = "America/Hermosillo";
                        break;
                    case "27":
                        $timezone = "America/Merida";
                        break;
                    case "28":
                        $timezone = "America/Monterrey";
                        break;
                    case "29":
                        $timezone = "America/Mexico_City";
                        break;
                    case "30":
                        $timezone = "America/Mexico_City";
                        break;
                    case "31":
                        $timezone = "America/Merida";
                        break;
                    case "32":
                        $timezone = "America/Monterrey";
                        break;
                    default:
                        $timezone = "America/Mexico_City";
                }
                break;
            case "MY":
                switch ($region) {
                    case "01":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "02":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "03":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "04":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "05":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "06":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "07":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "08":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "09":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "11":
                        $timezone = "Asia/Kuching";
                        break;
                    case "12":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "13":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "14":
                        $timezone = "Asia/Kuala_Lumpur";
                        break;
                    case "15":
                        $timezone = "Asia/Kuching";
                        break;
                    case "16":
                        $timezone = "Asia/Kuching";
                        break;
                    default:
                        $timezone = "Asia/Kuala_Lumpur";
                }
                break;
            case "MZ":
                $timezone = "Africa/Maputo";
                break;
            case "NA":
                $timezone = "Africa/Windhoek";
                break;
            case "NC":
                $timezone = "Pacific/Noumea";
                break;
            case "NE":
                $timezone = "Africa/Niamey";
                break;
            case "NF":
                $timezone = "Pacific/Norfolk";
                break;
            case "NG":
                $timezone = "Africa/Lagos";
                break;
            case "NI":
                $timezone = "America/Managua";
                break;
            case "NL":
                $timezone = "Europe/Amsterdam";
                break;
            case "NO":
                $timezone = "Europe/Oslo";
                break;
            case "NP":
                $timezone = "Asia/Kathmandu";
                break;
            case "NR":
                $timezone = "Pacific/Nauru";
                break;
            case "NU":
                $timezone = "Pacific/Niue";
                break;
            case "NZ":
                switch ($region) {
                    case "85":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "E7":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "E8":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "E9":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "F1":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "F2":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "F3":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "F4":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "F5":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "F6":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "F7":
                        $timezone = "Pacific/Chatham";
                        break;
                    case "F8":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "F9":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "G1":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "G2":
                        $timezone = "Pacific/Auckland";
                        break;
                    case "G3":
                        $timezone = "Pacific/Auckland";
                        break;
                    default:
                        $timezone = "Pacific/Auckland";
                }
                break;
            case "OM":
                $timezone = "Asia/Muscat";
                break;
            case "PA":
                $timezone = "America/Panama";
                break;
            case "PE":
                $timezone = "America/Lima";
                break;
            case "PF":
                $timezone = "Pacific/Marquesas";
                break;
            case "PG":
                $timezone = "Pacific/Port_Moresby";
                break;
            case "PH":
                $timezone = "Asia/Manila";
                break;
            case "PK":
                $timezone = "Asia/Karachi";
                break;
            case "PL":
                $timezone = "Europe/Warsaw";
                break;
            case "PM":
                $timezone = "America/Miquelon";
                break;
            case "PN":
                $timezone = "Pacific/Pitcairn";
                break;
            case "PR":
                $timezone = "America/Puerto_Rico";
                break;
            case "PS":
                $timezone = "Asia/Gaza";
                break;
            case "PT":
                switch ($region) {
                    case "02":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "03":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "04":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "05":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "06":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "07":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "08":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "09":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "10":
                        $timezone = "Atlantic/Madeira";
                        break;
                    case "11":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "13":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "14":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "16":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "17":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "18":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "19":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "20":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "21":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "22":
                        $timezone = "Europe/Lisbon";
                        break;
                    case "23":
                        $timezone = "Atlantic/Azores";
                        break;
                    default:
                        $timezone = "Europe/Lisbon";
                }
                break;
            case "PW":
                $timezone = "Pacific/Palau";
                break;
            case "PY":
                $timezone = "America/Asuncion";
                break;
            case "QA":
                $timezone = "Asia/Qatar";
                break;
            case "RE":
                $timezone = "Indian/Reunion";
                break;
            case "RO":
                $timezone = "Europe/Bucharest";
                break;
            case "RS":
                $timezone = "Europe/Belgrade";
                break;
            case "RU":
                switch ($region) {
                    case "01":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "02":
                        $timezone = "Asia/Irkutsk";
                        break;
                    case "03":
                        $timezone = "Asia/Novokuznetsk";
                        break;
                    case "04":
                        $timezone = "Asia/Novosibirsk";
                        break;
                    case "05":
                        $timezone = "Asia/Vladivostok";
                        break;
                    case "06":
                        $timezone = "Europe/Moscow";
                        break;
                    case "07":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "08":
                        $timezone = "Europe/Samara";
                        break;
                    case "09":
                        $timezone = "Europe/Moscow";
                        break;
                    case "10":
                        $timezone = "Europe/Moscow";
                        break;
                    case "11":
                        $timezone = "Asia/Irkutsk";
                        break;
                    case "12":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "13":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "14":
                        $timezone = "Asia/Irkutsk";
                        break;
                    case "15":
                        $timezone = "Asia/Anadyr";
                        break;
                    case "16":
                        $timezone = "Europe/Samara";
                        break;
                    case "17":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "18":
                        $timezone = "Asia/Krasnoyarsk";
                        break;
                    case "20":
                        $timezone = "Asia/Irkutsk";
                        break;
                    case "21":
                        $timezone = "Europe/Moscow";
                        break;
                    case "22":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "23":
                        $timezone = "Europe/Kaliningrad";
                        break;
                    case "24":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "25":
                        $timezone = "Europe/Moscow";
                        break;
                    case "26":
                        $timezone = "Asia/Kamchatka";
                        break;
                    case "27":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "28":
                        $timezone = "Europe/Moscow";
                        break;
                    case "29":
                        $timezone = "Asia/Novokuznetsk";
                        break;
                    case "30":
                        $timezone = "Asia/Vladivostok";
                        break;
                    case "31":
                        $timezone = "Asia/Krasnoyarsk";
                        break;
                    case "32":
                        $timezone = "Asia/Omsk";
                        break;
                    case "33":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "34":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "35":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "36":
                        $timezone = "Asia/Anadyr";
                        break;
                    case "37":
                        $timezone = "Europe/Moscow";
                        break;
                    case "38":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "39":
                        $timezone = "Asia/Krasnoyarsk";
                        break;
                    case "40":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "41":
                        $timezone = "Europe/Moscow";
                        break;
                    case "42":
                        $timezone = "Europe/Moscow";
                        break;
                    case "43":
                        $timezone = "Europe/Moscow";
                        break;
                    case "44":
                        $timezone = "Asia/Magadan";
                        break;
                    case "45":
                        $timezone = "Europe/Samara";
                        break;
                    case "46":
                        $timezone = "Europe/Samara";
                        break;
                    case "47":
                        $timezone = "Europe/Moscow";
                        break;
                    case "48":
                        $timezone = "Europe/Moscow";
                        break;
                    case "49":
                        $timezone = "Europe/Moscow";
                        break;
                    case "50":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "51":
                        $timezone = "Europe/Moscow";
                        break;
                    case "52":
                        $timezone = "Europe/Moscow";
                        break;
                    case "53":
                        $timezone = "Asia/Novosibirsk";
                        break;
                    case "54":
                        $timezone = "Asia/Omsk";
                        break;
                    case "55":
                        $timezone = "Europe/Samara";
                        break;
                    case "56":
                        $timezone = "Europe/Moscow";
                        break;
                    case "57":
                        $timezone = "Europe/Samara";
                        break;
                    case "58":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "59":
                        $timezone = "Asia/Vladivostok";
                        break;
                    case "60":
                        $timezone = "Europe/Kaliningrad";
                        break;
                    case "61":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "62":
                        $timezone = "Europe/Moscow";
                        break;
                    case "63":
                        $timezone = "Asia/Yakutsk";
                        break;
                    case "64":
                        $timezone = "Asia/Sakhalin";
                        break;
                    case "65":
                        $timezone = "Europe/Samara";
                        break;
                    case "66":
                        $timezone = "Europe/Moscow";
                        break;
                    case "67":
                        $timezone = "Europe/Samara";
                        break;
                    case "68":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "69":
                        $timezone = "Europe/Moscow";
                        break;
                    case "70":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "71":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "72":
                        $timezone = "Europe/Moscow";
                        break;
                    case "73":
                        $timezone = "Europe/Samara";
                        break;
                    case "74":
                        $timezone = "Asia/Krasnoyarsk";
                        break;
                    case "75":
                        $timezone = "Asia/Novosibirsk";
                        break;
                    case "76":
                        $timezone = "Europe/Moscow";
                        break;
                    case "77":
                        $timezone = "Europe/Moscow";
                        break;
                    case "78":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "79":
                        $timezone = "Asia/Irkutsk";
                        break;
                    case "80":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "81":
                        $timezone = "Europe/Samara";
                        break;
                    case "82":
                        $timezone = "Asia/Irkutsk";
                        break;
                    case "83":
                        $timezone = "Europe/Moscow";
                        break;
                    case "84":
                        $timezone = "Europe/Volgograd";
                        break;
                    case "85":
                        $timezone = "Europe/Moscow";
                        break;
                    case "86":
                        $timezone = "Europe/Moscow";
                        break;
                    case "87":
                        $timezone = "Asia/Novosibirsk";
                        break;
                    case "88":
                        $timezone = "Europe/Moscow";
                        break;
                    case "89":
                        $timezone = "Asia/Vladivostok";
                        break;
                    case "90":
                        $timezone = "Asia/Yekaterinburg";
                        break;
                    case "91":
                        $timezone = "Asia/Krasnoyarsk";
                        break;
                    case "92":
                        $timezone = "Asia/Anadyr";
                        break;
                    case "93":
                        $timezone = "Asia/Irkutsk";
                        break;
                    default:
                        $timezone = "Europe/Moscow";
                }
                break;
            case "RW":
                $timezone = "Africa/Kigali";
                break;
            case "SA":
                $timezone = "Asia/Riyadh";
                break;
            case "SB":
                $timezone = "Pacific/Guadalcanal";
                break;
            case "SC":
                $timezone = "Indian/Mahe";
                break;
            case "SD":
                $timezone = "Africa/Khartoum";
                break;
            case "SE":
                $timezone = "Europe/Stockholm";
                break;
            case "SG":
                $timezone = "Asia/Singapore";
                break;
            case "SH":
                $timezone = "Atlantic/St_Helena";
                break;
            case "SI":
                $timezone = "Europe/Ljubljana";
                break;
            case "SJ":
                $timezone = "Arctic/Longyearbyen";
                break;
            case "SK":
                $timezone = "Europe/Bratislava";
                break;
            case "SL":
                $timezone = "Africa/Freetown";
                break;
            case "SM":
                $timezone = "Europe/San_Marino";
                break;
            case "SN":
                $timezone = "Africa/Dakar";
                break;
            case "SO":
                $timezone = "Africa/Mogadishu";
                break;
            case "SR":
                $timezone = "America/Paramaribo";
                break;
            case "SS":
                $timezone = "Africa/Juba";
                break;
            case "ST":
                $timezone = "Africa/Sao_Tome";
                break;
            case "SV":
                $timezone = "America/El_Salvador";
                break;
            case "SX":
                $timezone = "America/Curacao";
                break;
            case "SY":
                $timezone = "Asia/Damascus";
                break;
            case "SZ":
                $timezone = "Africa/Mbabane";
                break;
            case "TC":
                $timezone = "America/Grand_Turk";
                break;
            case "TD":
                $timezone = "Africa/Ndjamena";
                break;
            case "TF":
                $timezone = "Indian/Kerguelen";
                break;
            case "TG":
                $timezone = "Africa/Lome";
                break;
            case "TH":
                $timezone = "Asia/Bangkok";
                break;
            case "TJ":
                $timezone = "Asia/Dushanbe";
                break;
            case "TK":
                $timezone = "Pacific/Fakaofo";
                break;
            case "TL":
                $timezone = "Asia/Dili";
                break;
            case "TM":
                $timezone = "Asia/Ashgabat";
                break;
            case "TN":
                $timezone = "Africa/Tunis";
                break;
            case "TO":
                $timezone = "Pacific/Tongatapu";
                break;
            case "TR":
                $timezone = "Asia/Istanbul";
                break;
            case "TT":
                $timezone = "America/Port_of_Spain";
                break;
            case "TV":
                $timezone = "Pacific/Funafuti";
                break;
            case "TW":
                $timezone = "Asia/Taipei";
                break;
            case "TZ":
                $timezone = "Africa/Dar_es_Salaam";
                break;
            case "UA":
                switch ($region) {
                    case "01":
                        $timezone = "Europe/Kiev";
                        break;
                    case "02":
                        $timezone = "Europe/Kiev";
                        break;
                    case "03":
                        $timezone = "Europe/Uzhgorod";
                        break;
                    case "04":
                        $timezone = "Europe/Zaporozhye";
                        break;
                    case "05":
                        $timezone = "Europe/Zaporozhye";
                        break;
                    case "06":
                        $timezone = "Europe/Uzhgorod";
                        break;
                    case "07":
                        $timezone = "Europe/Zaporozhye";
                        break;
                    case "08":
                        $timezone = "Europe/Simferopol";
                        break;
                    case "09":
                        $timezone = "Europe/Kiev";
                        break;
                    case "10":
                        $timezone = "Europe/Zaporozhye";
                        break;
                    case "11":
                        $timezone = "Europe/Simferopol";
                        break;
                    case "12":
                        $timezone = "Europe/Kiev";
                        break;
                    case "13":
                        $timezone = "Europe/Kiev";
                        break;
                    case "14":
                        $timezone = "Europe/Zaporozhye";
                        break;
                    case "15":
                        $timezone = "Europe/Uzhgorod";
                        break;
                    case "16":
                        $timezone = "Europe/Zaporozhye";
                        break;
                    case "17":
                        $timezone = "Europe/Simferopol";
                        break;
                    case "18":
                        $timezone = "Europe/Zaporozhye";
                        break;
                    case "19":
                        $timezone = "Europe/Kiev";
                        break;
                    case "20":
                        $timezone = "Europe/Simferopol";
                        break;
                    case "21":
                        $timezone = "Europe/Kiev";
                        break;
                    case "22":
                        $timezone = "Europe/Uzhgorod";
                        break;
                    case "23":
                        $timezone = "Europe/Kiev";
                        break;
                    case "24":
                        $timezone = "Europe/Uzhgorod";
                        break;
                    case "25":
                        $timezone = "Europe/Uzhgorod";
                        break;
                    case "26":
                        $timezone = "Europe/Zaporozhye";
                        break;
                    case "27":
                        $timezone = "Europe/Kiev";
                        break;
                    default:
                        $timezone = "Europe/Kiev";
                }
                break;
            case "UG":
                $timezone = "Africa/Kampala";
                break;
            case "UM":
                $timezone = "Pacific/Wake";
                break;
            case "US":
                switch ($region) {
                    case "AK":
                        $timezone = "America/Anchorage";
                        break;
                    case "AL":
                        $timezone = "America/Chicago";
                        break;
                    case "AR":
                        $timezone = "America/Chicago";
                        break;
                    case "AZ":
                        $timezone = "America/Phoenix";
                        break;
                    case "CA":
                        $timezone = "America/Los_Angeles";
                        break;
                    case "CO":
                        $timezone = "America/Denver";
                        break;
                    case "CT":
                        $timezone = "America/New_York";
                        break;
                    case "DC":
                        $timezone = "America/New_York";
                        break;
                    case "DE":
                        $timezone = "America/New_York";
                        break;
                    case "FL":
                        $timezone = "America/New_York";
                        break;
                    case "GA":
                        $timezone = "America/New_York";
                        break;
                    case "HI":
                        $timezone = "Pacific/Honolulu";
                        break;
                    case "IA":
                        $timezone = "America/Chicago";
                        break;
                    case "ID":
                        $timezone = "America/Denver";
                        break;
                    case "IL":
                        $timezone = "America/Chicago";
                        break;
                    case "IN":
                        $timezone = "America/Indiana/Indianapolis";
                        break;
                    case "KS":
                        $timezone = "America/Chicago";
                        break;
                    case "KY":
                        $timezone = "America/New_York";
                        break;
                    case "LA":
                        $timezone = "America/Chicago";
                        break;
                    case "MA":
                        $timezone = "America/New_York";
                        break;
                    case "MD":
                        $timezone = "America/New_York";
                        break;
                    case "ME":
                        $timezone = "America/New_York";
                        break;
                    case "MI":
                        $timezone = "America/New_York";
                        break;
                    case "MN":
                        $timezone = "America/Chicago";
                        break;
                    case "MO":
                        $timezone = "America/Chicago";
                        break;
                    case "MS":
                        $timezone = "America/Chicago";
                        break;
                    case "MT":
                        $timezone = "America/Denver";
                        break;
                    case "NC":
                        $timezone = "America/New_York";
                        break;
                    case "ND":
                        $timezone = "America/Chicago";
                        break;
                    case "NE":
                        $timezone = "America/Chicago";
                        break;
                    case "NH":
                        $timezone = "America/New_York";
                        break;
                    case "NJ":
                        $timezone = "America/New_York";
                        break;
                    case "NM":
                        $timezone = "America/Denver";
                        break;
                    case "NV":
                        $timezone = "America/Los_Angeles";
                        break;
                    case "NY":
                        $timezone = "America/New_York";
                        break;
                    case "OH":
                        $timezone = "America/New_York";
                        break;
                    case "OK":
                        $timezone = "America/Chicago";
                        break;
                    case "OR":
                        $timezone = "America/Los_Angeles";
                        break;
                    case "PA":
                        $timezone = "America/New_York";
                        break;
                    case "RI":
                        $timezone = "America/New_York";
                        break;
                    case "SC":
                        $timezone = "America/New_York";
                        break;
                    case "SD":
                        $timezone = "America/Chicago";
                        break;
                    case "TN":
                        $timezone = "America/Chicago";
                        break;
                    case "TX":
                        $timezone = "America/Chicago";
                        break;
                    case "UT":
                        $timezone = "America/Denver";
                        break;
                    case "VA":
                        $timezone = "America/New_York";
                        break;
                    case "VT":
                        $timezone = "America/New_York";
                        break;
                    case "WA":
                        $timezone = "America/Los_Angeles";
                        break;
                    case "WI":
                        $timezone = "America/Chicago";
                        break;
                    case "WV":
                        $timezone = "America/New_York";
                        break;
                    case "WY":
                        $timezone = "America/Denver";
                        break;
                    default:
                        $timezone = "America/New_York";
                }
                break;
            case "UY":
                $timezone = "America/Montevideo";
                break;
            case "UZ":
                switch ($region) {
                    case "01":
                        $timezone = "Asia/Tashkent";
                        break;
                    case "02":
                        $timezone = "Asia/Samarkand";
                        break;
                    case "03":
                        $timezone = "Asia/Tashkent";
                        break;
                    case "05":
                        $timezone = "Asia/Samarkand";
                        break;
                    case "06":
                        $timezone = "Asia/Tashkent";
                        break;
                    case "07":
                        $timezone = "Asia/Samarkand";
                        break;
                    case "08":
                        $timezone = "Asia/Samarkand";
                        break;
                    case "09":
                        $timezone = "Asia/Samarkand";
                        break;
                    case "10":
                        $timezone = "Asia/Samarkand";
                        break;
                    case "12":
                        $timezone = "Asia/Samarkand";
                        break;
                    case "13":
                        $timezone = "Asia/Tashkent";
                        break;
                    case "14":
                        $timezone = "Asia/Tashkent";
                        break;
                    default:
                        $timezone = "Asia/Tashkent";
                }
                break;
            case "VA":
                $timezone = "Europe/Vatican";
                break;
            case "VC":
                $timezone = "America/St_Vincent";
                break;
            case "VE":
                $timezone = "America/Caracas";
                break;
            case "VG":
                $timezone = "America/Tortola";
                break;
            case "VI":
                $timezone = "America/St_Thomas";
                break;
            case "VN":
                $timezone = "Asia/Phnom_Penh";
                break;
            case "VU":
                $timezone = "Pacific/Efate";
                break;
            case "WF":
                $timezone = "Pacific/Wallis";
                break;
            case "WS":
                $timezone = "Pacific/Pago_Pago";
                break;
            case "YE":
                $timezone = "Asia/Aden";
                break;
            case "YT":
                $timezone = "Indian/Mayotte";
                break;
            case "YU":
                $timezone = "Europe/Belgrade";
                break;
            case "ZA":
                $timezone = "Africa/Johannesburg";
                break;
            case "ZM":
                $timezone = "Africa/Lusaka";
                break;
            case "ZW":
                $timezone = "Africa/Harare";
                break;
        }
        return $timezone;
    }

    protected function getCountryCode($countryName) {

        $countries = array(
            'AF' => 'Afghanistan',
            'AX' => 'Aland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua And Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia And Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, Democratic Republic',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'Ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island & Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic Of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle Of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KR' => 'Korea',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States Of',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'BL' => 'Saint Barthelemy',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts And Nevis',
            'LC' => 'Saint Lucia',
            'MF' => 'Saint Martin',
            'PM' => 'Saint Pierre And Miquelon',
            'VC' => 'Saint Vincent And Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome And Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia And Sandwich Isl.',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard And Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad And Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks And Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis And Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        );
        foreach ($countries as $code => $country) {
            if ($country == $countryName) {
                return $code;
            }

        }
    }

    /**
     * Return JSON Leads
     */
    public function index() {
        $leads = new LeadsResource($this->lead->whereNull('archived_at')->whereNull('converted_at')->with([
            'AsSource:id,name',
            'status:id,name',
            'agent:id,email,name,username'
        ])->orderByDesc('id')->paginate(50));

        return response($leads, Response::HTTP_OK);
    }

    /**
     * Show Lead
     */
    public function show($id = null) {

        $lead = $this->lead->findOrFail($id);

        return response(new LeadResource($lead), Response::HTTP_OK);
    }

    /**
     * Save new lead
     */
    public function save(LeadsRequest $request) {
        logger('api start');
        logger($request);
        logger('api end');
        if(!$request->has('country')){
            return response('', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $countryCode = $this->getCountryCode($request->all()['country']);
        $timeZone = $this->get_time_zone($countryCode);

        logger('country code start');
        logger($countryCode);
        logger('country code end');
        logger('timezone start');
        logger($timeZone);
        logger('timezone end');


        if (!$request->desk) {
            $request->desk = 1;
        }
        if (!empty($timeZone)) {
            $lead = $this->lead->firstOrCreate([
                'email'    => $request->email,
                'desk_id'  => $request->desk,
                'timezone' => $timeZone
            ], $request->except([
                'custom',
                'tags'
            ]));
        } else {
            $lead = $this->lead->firstOrCreate([
                'email'   => $request->email,
                'desk_id' => $request->desk
            ], $request->except([
                'custom',
                'tags'
            ]));
        }


        logger($lead);
        return ajaxResponse([
            'id'       => $lead->id,
            'message'  => langapp('saved_successfully'),
            'redirect' => route('leads.view', $lead->id),
        ], true, Response::HTTP_CREATED);
    }

    /**
     * Update lead
     */
    public function update(LeadsRequest $request, $id = null) {

        $request->validate(['email' => 'unique:leads,email,' . $id]);
        $lead = $this->lead->findOrFail($id);
        $leadID = $lead->id;
        $lead->update($request->except([
            'custom',
            'tags'
        ]));
        $lead->update(['desk_id' => $request->all()['desk']]);

        return ajaxResponse([
            'id'       => $leadID,
            'message'  => langapp('changes_saved_successful'),
            'redirect' => route('leads.view', $leadID),
        ], true, Response::HTTP_OK);
    }

    /**
     * Convert lead to opportunity
     */
    public function convert($id) {
        $this->request->validate([
            'deal_title' => 'required',
            'id'         => 'required'
        ]);
        $this->request->request->add(['converting' => 1]);
        $lead = $this->lead->findOrFail($id);
        $lead->stage_id = 54;
        $data = $lead->toCustomer();
        logger($data);
        event(new LeadConverted($lead, \Auth::id()));

        return ajaxResponse($data);
    }

    /**
     * Move lead to next stage
     */
    public function nextStage($id = null) {
        $this->request->validate(['stage' => 'required']);
        $lead = $this->lead->findOrFail($id);
        $lead->update(['stage_id' => $this->request->stage]);
        return ajaxResponse([
            'id'       => $lead->id,
            'message'  => langapp('saved_successfully'),
            'redirect' => $this->request->url,
        ], true, Response::HTTP_OK);
    }

    /**
     * Move lead to specified stage
     */
    public function moveStage() {
        $target_id = \App\Entities\Category::whereName(humanize($this->request->target))->first()->id;
        $lead = $this->lead->findOrFail($this->request->id);
        $lead->update(['stage_id' => $target_id]);
        return ajaxResponse([
            'id'      => $lead->id,
            'message' => langapp('lead_stage_changed', [
                'name'  => $lead->name,
                'stage' => humanize($this->request->target)
            ]),
        ], true, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calls($id = null) {
        $lead = $this->lead->findOrFail($id);
        $calls = new CallsResource($lead->calls()->orderBy('id', 'desc')->paginate(50));
        return response($calls, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todos($id = null) {
        $lead = $this->lead->findOrFail($id);
        $todos = new TodosResource($lead->todos()->with(['agent:id,username,name'])->orderBy('id', 'desc')->paginate(50));
        return response($todos, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comments($id = null) {
        $lead = $this->lead->findOrFail($id);
        $comments = new CommentsResource($lead->comments()->orderBy('id', 'desc')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }

    /**
     * Delete a lead
     */
    public function delete($id = null) {
        $lead = $this->lead->findOrFail($id);
        $lead->delete();
        return ajaxResponse([
            'message'  => langapp('deleted_successfully'),
            'redirect' => route('leads.index'),
        ], true, Response::HTTP_OK);
    }
}
