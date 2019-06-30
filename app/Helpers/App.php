<?php

use App\Entities\Hook;
use App\Entities\Language;
use App\Entities\Local;
use App\Services\SvgFactory;
use Facades\App\Helpers\CurrencyConverter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\Settings\Entities\Options;
use Modules\Tickets\Entities\Ticket;
use Modules\Timetracking\Entities\TimeEntry;
use Modules\Users\Entities\Profile;
use Modules\Users\Entities\User;
use Stringy\Stringy as S;

function getLangCode($name) {
    return \App\Entities\Language::whereName($name)->first()->code;
}

function langapp($key, $params = [], $locale = 'en') {

    return trans("app.{$key}", $params, $locale == 'en' ? app()->getLocale() : $locale);
}

function langdate($key, $params = [], $locale = 'en') {
    return trans("date.{$key}", $params, $locale == 'en' ? app()->getLocale() : $locale);
}

function langactivity($key, $params = [], $locale = 'en') {
    return trans("activity.{$key}", $params, $locale == 'en' ? app()->getLocale() : $locale);
}

function langinstall($key, $params = [], $locale = 'en') {
    return trans("install.{$key}", $params, $locale);
}

function langmail($key, $params = [], $locale = 'en') {
    return trans("mail.{$key}", $params, $locale == 'en' ? app()->getLocale() : $locale);
}

/**
 * Get App configuration.
 *
 * @param string $key
 */
function config_item($key) {
    return get_option($key);
}

function getAsset($path, $secure = null) {
    $timestamp = @filemtime(public_path($path)) ?: 0;
    return asset($path, $secure) . '?' . $timestamp;
}

function systemFont() {
    return app('typography')->font();
}

function activeCalendar($cal = null) {
    if (!is_null($cal)) {
        session(['active_cal' => $cal]);
    }

    return session('active_cal', get_option('default_calendar'));
}

/**
 * @param  string $text
 * @return string
 */
function parsedown($text) {
    /**
     * @var Parsedown $parser
     */
    $parser = app('parsedown');

    return $parser->text($text);
}

if (!function_exists('toastr')) {
    /**
     * Return the instance of toastr.
     *
     * @return App\Services\Toastr
     */
    function toastr() {
        return app('toastr');
    }
}

/**
 * Get App configuration.
 *
 * @param string $option
 * @param string $default
 */
function get_option($option, $default = null) {
    $settings = cache(settingsCacheName());
    return isset($settings[$option]) ? $settings[$option] : $default;
}

function slugAppName() {
    return Str::slug(config('app.name'), '_');
}

function settingsCacheName() {
    return slugAppName() . '-' . 'settings';
}

function isDemo() {
    return settingEnabled('demo_mode') ? true : false;
}

function trackEmail($id) {
    if (config('system.track_emails')) {
        return '![](' . route('tracker.email', ['mail' => $id]) . ' "")';
    }
    return '';
}

function settingEnabled($setting) {
    return get_option($setting) === 'TRUE' ? true : false;
}

if (!function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param  string|array $route
     * @param  string $className
     * @return string
     */
    function isActive($route, $className = 'active') {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}

if (!function_exists('slack')) {
    function slack($webhook_url = null) {
        return \App\Services\Slack::make($webhook_url);
    }
}

function isCommentLocked($type, $id) {
    if ($type === get_class(new Ticket)) {
        $ticket = Ticket::find($id);
        return ($ticket->is_locked && $ticket->locked_by != Auth::id()) ? true : false;
    }
    return false;
}

function genUnique() {
    return uniqid('crm_');
}

function genNumber() {
    return mt_rand(10000000, 99999999);
}

function classByName($name) {
    switch ($name) {
        case 'deals':
            return new \Modules\Deals\Entities\Deal;
            break;
        case 'leads':
            return new \Modules\Leads\Entities\Lead;
            break;
        case 'events':
            return new \Modules\Calendar\Entities\Calendar;
            break;
        case 'issues':
            return new \Modules\Issues\Entities\Issue;
            break;
        case 'tasks':
            return new \Modules\Tasks\Entities\Task;
            break;
        case 'tickets':
            return new \Modules\Tickets\Entities\Ticket;
            break;
        case 'clients':
            return new \Modules\Clients\Entities\Client;
            break;
        case 'projects':
            return new \Modules\Projects\Entities\Project;
            break;
        case 'users':
            return new \Modules\Users\Entities\User;
            break;
        case 'invoices':
            return new \Modules\Invoices\Entities\Invoice;
            break;
        case 'estimates':
            return new \Modules\Estimates\Entities\Estimate;
            break;
        case 'credits':
            return new \Modules\Creditnotes\Entities\CreditNote;
            break;
        case 'expenses':
            return new \Modules\Expenses\Entities\Expense;
            break;
        case 'messages':
            return new \Modules\Messages\Entities\Message;
            break;
        case 'payments':
            return new \Modules\Payments\Entities\Payment;
            break;
        case 'knowledgebase':
            return new \Modules\Knowledgebase\Entities\Knowledgebase;
            break;
        case 'contracts':
            return new \Modules\Contracts\Entities\Contract;
            break;
        case 'comments':
            return new \Modules\Comments\Entities\Comment;
            break;
        case 'emails':
            return new \Modules\Messages\Entities\Emailing;
            break;

        default:
            break;
    }
}

if (!function_exists('trCode')) {
    /**
     * Generate a unique transaction number.
     *
     * @param string $prefix
     * @param bool $entropy
     *
     * @return string
     */
    function trCode(string $prefix = null, $entropy = false) {
        $s = uniqid('', $entropy);
        if (!$entropy) {
            $uuid = mb_strtoupper(base_convert($s, 16, 36));
        } else {
            $hex = substr($s, 0, 13);
            $dec = $s[13] . substr($s, 15); // skip the dot
            $uuid = mb_strtoupper(base_convert($hex, 16, 36) . base_convert($dec, 10, 36));
        }

        return $prefix ? $prefix . '-' . $uuid : $uuid;
    }
}

/*
 * Return current version (as plain text).
 */
function getCurrentVersion() {
    return json_decode(file_get_contents(storage_path('app/version.json')), true);
}

function getLastVersion() {
    return json_decode(file_get_contents(storage_path('app/updates/update.json')), true);
}

function getLastReminder() {
    return json_decode(file_get_contents(storage_path('app/updates/last_reminder.json')), true);
}

/**
 * Update App configuration.
 *
 * @param string $key
 * @param string $value
 */
function update_option($key, $value) {
    return Options::updateOrCreate(['config_key' => $key], ['value' => $value]);
}

function renderButton($key) {
    return '<button type="submit" class="btn btn-' . get_option('theme_color') . ' formSaving submit"><i class="fas fa-paper-plane"></i> ' . $key . '</button>';
}

function invoiceStatusColor($status) {
    switch ($status) {
        case langapp('viewed'):
            return 'info';
            break;
        case langapp('sent'):
            return 'success';
            break;
        case langapp('overdue'):
            return 'danger';
            break;

        default:
            return 'default';
            break;
    }
}

function languages() {
    return Cache::remember('active-lang', now()->addDays(5), function () {
        return Language::where('active', 1)->get()->toArray();
    });
}

function locales() {
    return Cache::remember('workice-locales', now()->addDays(5), function () {
        return App\Entities\Local::groupBy('language')->get()->toArray();
    });
}

function currencies() {
    return Cache::remember('workice-currencies', now()->addDays(5), function () {
        return App\Entities\Currency::get()->toArray();
    });
}

function countries() {
    return Cache::remember('workice-countries', now()->addDays(5), function () {
        return \App\Entities\Country::select('name')->get()->toArray();
    });
}

function site_url($uri = '') {
    return URL::to($uri);
}

function generateCode($module = 'invoices') {
    return classByName($module)->nextCode();
}

/**
 * Modify reference number
 *
 * @param  string $str
 * @param  string $ref
 * @return string
 */
function referenceFormatted($str, $ref) {
    $str = str_replace('[yyyy]', (string)now()->year, $str);
    $str = str_replace('[mm]', date('m'), $str);
    $str = str_replace('[dd]', date('d'), $str);
    $str = str_replace('[i]', $ref, $str);
    return $str;
}

function formatPhoneNumber($number) {
    $number = preg_replace("/[^\d]/", "", $number);
    $length = strlen($number);
    if ($length == 10) {
        $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $number);
    }
    return $number;
}

function localizeNum($num) {
    $formatStyle = \NumberFormatter::DECIMAL;
    return (new \NumberFormatter(get_option('locale'), $formatStyle))->format($num);
}

function thousandsCurrencyFormat($num) {
    if ($num > 1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array(
            'k',
            'm',
            'b',
            't'
        );
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int)$x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
    }
    return $num;
}

function getUrlMeta($url) {
    $finder = new \App\Services\MetaFinder;
    return $finder->getMeta($url);
    // if (intval($url) > 0) {
    //     $url = $this->links->findOrFail($url)->url;
    // }
    // $data = file_get_contents($url);
    // $meta = get_meta_tags($url);

    // $meta['title'] = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;

    //return $meta;
}

function getIcon($ext) {
    return \Modules\Files\Helpers\MimeIcon::getIcon($ext);
}

function genToken() {
    return md5(rand() . microtime());
}

function getLocaleUsingLanguage($language = 'english') {
    return Local::whereLanguage($language)->first()->code;
}

function languageUsingLocale($locale = 'en') {
    return Local::whereCode($locale)->first()->language;
}

function stripAccents($string) {
    $chars = array(
        'Ά' => 'Α',
        'ά' => 'α',
        'Έ' => 'Ε',
        'έ' => 'ε',
        'Ή' => 'Η',
        'ή' => 'η',
        'Ί' => 'Ι',
        'ί' => 'ι',
        'Ό' => 'Ο',
        'ό' => 'ο',
        'Ύ' => 'Υ',
        'ύ' => 'υ',
        'Ώ' => 'Ω',
        'ώ' => 'ω'
    );
    foreach ($chars as $find => $replace) {
        $string = str_replace($find, $replace, $string);
    }

    return $string;
}

function chartYear() {
    $year = date('Y');
    if (request()->has('setyear')) {
        cache(['chart-year' => request('setyear')], now()->addHours(12));
    }
    return cache('chart-year', $year);
}

function fullname($id = null) {
    if (is_null($id)) {
        return Auth::user()->name;
    }

    return optional(User::find($id))->name;
}

function can($permission) {
    return Auth::user()->hasPermissionTo($permission);
}

function runningTimers() {
    return Cache::remember('running-timers-' . \Auth::id(), now()->addMinutes(2), function () {
        return TimeEntry::select('user_id', 'timeable_type', 'timeable_id', 'start', 'task_id')->with('timeable:id,name', 'user:id,email,username,name')->running()->orderBy('id', 'desc')->get()->toArray();
    });
}

function convertCurrency($from, $amount, $to = null, $xrate = null) {
    return CurrencyConverter::convert($from, $amount, $to, $xrate);
}

function formatCurrency($currency, $amount) {
    return CurrencyConverter::toCurrency($currency, $amount);
}

function formatQuantity($amount) {
    $dec = get_option('quantity_decimals');
    $dec_sep = get_option('decimal_separator');
    $thou_sep = get_option('thousand_separator');

    return number_format($amount, $dec, $dec_sep, $thou_sep);
}

function formatTax($amount) {
    $dec = get_option('tax_decimals');
    $dec_sep = get_option('decimal_separator');
    $thou_sep = get_option('thousand_separator');
    return number_format($amount, $dec, $dec_sep, $thou_sep);
}

function toWords($amount, $currency) {
    $transformer = new App\Helpers\ToWords($amount * 100, $currency);

    return $transformer->words();
}

function getImageStorageUrl($fileName) {
    return Storage::disk('public')->url('images/' . $fileName);
}

function getStorageUrl($path) {
    return Storage::url($path);
}

function parseCurrency($money) {
    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
    $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '', $stringWithCommaOrDot);

    return (float)str_replace(',', '.', $removedThousandSeparator);
}

/**
 * Format decimal
 *
 * @param  mixed $num
 * @param  int $dec
 * @return string
 */
function formatDecimal($num, $dec = 2) {
    $number = str_replace(',', '.', $num);

    return number_format((float)$number, $dec, '.', '');
}

function xchangeRate($currency = 'USD') {
    return optional(App\Entities\Currency::select('xrate')->whereCode($currency)->first())->xrate;
}

function percent($num) {
    return round($num);
}

function userCalendarToken() {
    if (is_null(\Auth::user()->calendar_token)) {
        \Auth::user()->update(['calendar_token' => str_random(60)]);
    }
    return \Auth::user()->calendar_token;
}

function calendarLocale() {
    return Cache::remember('calendarLocale', now()->addDays(10), function () {
        return get_option('locale', 'en-gb');
    });
}

function datePickerLocale() {
    return Cache::remember('datepickerLocale', now()->addDays(10), function () {
        if (get_option('locale') == 'en') {
            return 'en-GB';
        }
        return get_option('locale');
    });
}

function editorLocale() {
    return Cache::remember('editorLocale', now()->addDays(10), function () {
        return get_option('locale');
    });
}

function mainMenu() {
    $cacheMenus = Cache::remember('workice-main-menu-' . \Auth::id(), now()->addDays(5), function () {
        $collection = Hook::with('children')->where('visible', 1)->whereParent('')->whereHook('main_menu')->orderBy('order')->get();

        return $collection->filter(function ($item) {
            if (\Auth::user()->can($item['module'])) {
                return $item;
            }
        })->toArray();
    });
    foreach ($cacheMenus as $key => $menu) {
        if ($menu['name'] == 'sales' ||
            $menu['name'] == 'deals' ||
            $menu['name'] == 'contacts' ||
            $menu['name'] == 'contracts' ||
            $menu['name'] == 'accounts' ||
            $menu['name'] == 'projects'||
            $menu['name'] == 'tasks' ||
            $menu['name'] == 'subscriptions' ) {
            unset($cacheMenus[$key]);
        }
    }
    return $cacheMenus;
}

function projectMenu() {
    return Hook::where([
        'access'  => 1,
        'visible' => 1,
        'hook'    => 'projects_menu_admin'
    ])->orderBy('order')->get();
}

function settingsMenu() {
    return Hook::where([
        'hook'    => 'settings_menu_admin',
        'visible' => 1
    ])->orderBy('order', 'asc')->get();
}

function avatar($id = null) {
    $avatarPhoto = getAsset('avatar/default_avatar.png');
    if (is_null($id)) {
        return \Auth::user()->profile->photo;
    }
    return Profile::whereUserId($id)->first()->photo;
}

function getAvatarImage($name) {
    return \Avatar::create($name)->toBase64();
}

// reduce large numbers to human thousand / million or metric K / M
function humanNumber($num, $places = 1, $type = 'metric') {
    if ($type == 'metric') {
        $k = 'K';
        $m = 'M';
    } else {
        $k = ' thousand';
        $m = ' million';
    }
    if ($num < 1000) {
        $num_format = number_format($num);
    } elseif ($num < 1000000) {
        $num_format = number_format($num / 1000, $places) . $k;
    } else {
        $num_format = number_format($num / 1000000, $places) . $m;
    }

    return $num_format;
}

function getCalculated($key) {
    return optional(App\Entities\Computed::select('value')->where('key', $key)->first())->value;
}

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function renderAjaxButton($text = 'save', $icon = 'fas fa-paper-plane', $overwriteText = false) {
    return '<button type="submit" class="btn btn-' . get_option('theme_color') . ' formSaving submit btn-rounded"><i class="' . $icon . '"></i> ' . langapp($text, [], app()->getLocale()) . '</button>';
}

function closeModalButton() {
    return '<a href="#" class="btn btn-default btn-rounded" data-dismiss="modal"><i class="fas fa-times text-muted"></i> ' . langapp('close', [], app()->getLocale()) . '</a>';
}

function okModalButton() {
    return '<button type="submit" class="btn btn-danger btn-rounded"><i class="fas fa-check"></i> ' . langapp('ok') . '</button>';
}

function ajaxResponse($data, $success = true, $code = 200) {
    $data['success'] = $success;

    return response()->json($data, $code);
}

function isJson($str) {
    return is_string($str) && is_array(json_decode($str, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}

if (!function_exists('moduleActive')) {
    /**
     * Check if a module is active
     */
    function moduleActive($module) {
        return Module::find($module)->enabled();
    }
}

function removeSpaces($str) {
    return Stringy\StaticStringy::stripWhitespace($str);
}

function strBetween($start, $end, $str) {
    return S::create($str)->between($start, $end)->__toString();
}

function getMentions($content) {
    $mention_regex = '/(^|\s)@([\w_\.]+)/'; //mention regrex to get all @texts
    preg_match_all($mention_regex, $content, $matches);
    return $matches[2];
}

function getUserIdExisting($username) {
    $select = [
        'id',
        'username'
    ];
    return is_null($username) ? \Auth::id() : User::select($select)->whereUsername($username)->count() > 0 ? User::select($select)->whereUsername($username)->first()->id : \Auth::id();
}

if (!function_exists('humanize')) {
    /**
     * Humanize.
     *
     * Takes multiple words separated by the separator and changes them to spaces
     *
     * @param string $str Input string
     * @param string $separator Input separator
     *
     * @return string
     */
    function humanize($str, $separator = '_') {
        return ucwords(preg_replace('/[' . preg_quote($separator) . ']+/', ' ', trim(extension_loaded('mbstring') ? mb_strtolower($str) : strtolower($str))));
    }
}

/**
 * Underscore.
 *
 * Takes multiple words separated by spaces and underscores them
 *
 * @param string $str Input string
 *
 * @return string
 */
function underscore($str) {
    return preg_replace('/[\s]+/', '_', trim(extension_loaded('mbstring') ? mb_strtolower($str) : strtolower($str)));
}

function isAdmin() {
    return Auth::check() ? Auth::user()->hasRole('admin') : false;
}

/**
 * Convert seconds to hours
 *
 * @param  string $seconds
 * @return float
 */
function toHours($seconds) {
    return $seconds > 0 ? formatDecimal($seconds / 3600, 3) : 0;
}

function secToHours($seconds) {
    $minutes = $seconds / 60;
    $hours = $minutes / 60;
    if ($minutes >= 60) {
        return round($hours, 2) . '' . langapp('hours');
    } elseif ($seconds > 60) {
        return round($minutes, 2) . ' ' . langapp('minutes');
    } else {
        return $seconds . ' ' . langapp('seconds');
    }
}

function priorityColor($priority) {
    switch ($priority) {
        case 'Low':
            return 'primary';
            break;
        case 'High':
            return 'dracula';
            break;
        case 'Urgent':
            return 'danger';
            break;
        default:
            return 'info';
    }
}

function toMarkdown($html) {
    $converter = new \League\HTMLToMarkdown\HtmlConverter();
    $converter->getConfig()->setOption('strip_tags', true);

    return $converter->convert($html);
}

function closeMatch($str1, $str2) {
    return levenshtein($str1, $str2) < 3 ? true : false;
}

function quickAccess() {
    return Cache::remember('quick-access-' . \Auth::id(), now()->addDays(5), function () {
        return \Auth::user()->quickAccess()->get()->toArray();
    });
}

function itemUnit() {
    return settingEnabled('dynamic_units') ? get_option('custom_item_unit') : stripAccents(langapp('unit_price'));
}

function slugify($str) {
    $search = array(
        'Ș',
        'Ț',
        'ş',
        'ţ',
        'Ş',
        'Ţ',
        'ș',
        'ț',
        'î',
        'â',
        'ă',
        'Î',
        'Â',
        'Ă',
        'ë',
        'Ë'
    );
    $replace = array(
        's',
        't',
        's',
        't',
        's',
        't',
        's',
        't',
        'i',
        'a',
        'a',
        'i',
        'a',
        'a',
        'e',
        'E'
    );
    $str = str_ireplace($search, $replace, strtolower(trim($str)));
    $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
    $str = str_replace(' ', '-', $str);

    return preg_replace('/\-{2,}/', '-', $str);
}

if (!function_exists('svg_spritesheet')) {
    function svg_spritesheet() {
        return app(SvgFactory::class)->spritesheet();
    }
}

if (!function_exists('svg_image')) {
    function svg_image($icon, $class = '', $attrs = []) {
        return app(SvgFactory::class)->svg($icon, $class, $attrs);
    }
}

if (!function_exists('svg_icon')) {
    /**
     * @deprecated Use `svg_image`
     */
    function svg_icon($icon, $class = '', $attrs = []) {
        return app(SvgFactory::class)->svg($icon, $class, $attrs);
    }
}

if (!function_exists('metrics')) {
    function metrics($str) {
        return formatCurrency(get_option('default_currency'), getCalculated($str));
    }
}

function getArrFromJson($path) {
    return json_decode(file_get_contents($path), true);
}

function urlAccessible($url) {
    $timeout = 10;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    $http_respond = curl_exec($ch);
    $http_respond = trim(strip_tags($http_respond));
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (($http_code == "200") || ($http_code == "302")) {
        return true;
    } else {
        // return $http_code;, possible too
        return false;
    }
    curl_close($ch);
}

if (!function_exists('_dd')) {
    function _dd($args) {
        http_response_code(500);
        dd($args);
    }
}
