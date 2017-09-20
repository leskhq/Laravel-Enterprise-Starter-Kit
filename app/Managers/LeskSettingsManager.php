<?php namespace App\Managers;

use App\Exceptions\InvalidFileException;
use App\Exceptions\InvalidPathException;
use Arcanedev\LaravelSettings\Contracts\Manager as SettingsManagerContract;
use Arcanedev\LaravelSettings\SettingsManager;
use App\Libraries\Str;
use App\Libraries\Utils;
use App\Exceptions\FileNotFoundException;
use Crypt;
use Illuminate\Foundation\Application;
use Settings;

class LeskSettingsManager extends SettingsManager implements SettingsManagerContract
{
    protected $app;

    protected $prefix = null;
    protected $delim  = '.';

    private static $ENCRYPTED_PREFIX = ":EnCrYpTeD:";

    /**
     * SettingsManager constructor.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    public function __construct(Application $app, $keyPrefix = null, $delimiter  = '.')
    {
        parent::__construct($app);

        $this->app = $app;
        $this->prefix = $keyPrefix;
        $this->delim = $delimiter;

    }

    private function underlyingGet($key, $defaultVal = null)
    {
        $val = null;

        // Try to get value from settings
        $val = parent::get($key);
        // If val is null, try to get value from config or environment.
        if (null === $val) {
            $val = Config( $key, env($key) );
        }
        // Finally if val is still null, assign the default value.
        if (null == $val) {
            $val = $defaultVal;
        }

        return $val;
    }

    public function flush()
    {
        $ret =  parent::flush();
        $this->save();

        return $ret;
    }


    public function has($key)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            $key = $this->prefix . $this->delim . $key;
        }

        return parent::has($key);
    }

    public function set($key, $value = null, $encrypt = false)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            $key = $this->prefix . $this->delim . $key;
        }

        if ($encrypt) {
            $value = $this->encrypt($value);
        }

        $ret = parent::set($key, $value);
        $this->save();

        return $ret;
    }

    public function forget($key = null)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            if (!Str::isNullOrEmptyString($key)) {
                $key = $this->prefix . $this->delim . $key;
            } else {
                $key = $this->prefix;
            }
        }

        $ret = parent::forget($key);
        $this->save();

        return $ret;
    }


    public function all()
    {
        $ret = null;

        // Get all settings
        $ret =  parent::all();

        // If the prefix is set, filter out all settings not under that prefix.
        if (!Str::isNullOrEmptyString($this->prefix)) {
            $pieces = explode($this->delim, $this->prefix);
            foreach ($pieces as $part) {
                if (array_key_exists($part, $ret)) {
                    $ret = $ret[$part];
                }
                else {
                    $ret = null;
                    break;
                }
            }
        }

        return $ret;
    }

    public function get($key, $defaultVal = null)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            $key = $this->prefix . $this->delim . $key;
        }

        $val = $this->underlyingGet($key, $defaultVal);

        if ( $this->isEncrypted($key, $val) ) {
            $val = $this->decrypt($val);
        }

        $val = Utils::correctType($val);
        return $val;
    }

    public function isSaved()
    {
        return parent::isSaved();
    }

    /**
     * @return mixed
     */
    public function save()
    {
        return parent::save();
    }

    /**
     * @param $val
     * @return bool
     */
    public function isEncrypted($key, $val = null)
    {
        if (!Str::isNullOrEmptyString($this->prefix)) {
            $key = $this->prefix . $this->delim . $key;
        }

        if (Str::isNullOrEmptyString($val)) {
            $val = $this->underlyingGet($key);
        }

        if ( is_string($val) && Str::startsWith($val, self::$ENCRYPTED_PREFIX) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $val
     * @return string
     */
    public function decrypt($val)
    {
        return Crypt::decrypt(substr($val, strlen(self::$ENCRYPTED_PREFIX)));
    }

    /**
     * @param $value
     * @return string
     */
    public function encrypt($value)
    {
        return self::$ENCRYPTED_PREFIX . Crypt::encrypt($value);
    }

    public function prefix()
    {
        return $this->prefix;
    }

    public function load($envName)
    {
        $nbRead = 0;
        $settingsArray = [];
        $dotEnv = null;

        $settingsFileName = ".settings-" . $envName;
        $settingsPath = $this->app->environmentPath();
        $settingsFullFileName = $settingsPath . '/' . $settingsFileName;

        if (\File::exists($settingsFullFileName)) {
            $nbRead = $this->loadSettings($settingsFullFileName);
        } else {
            throw new FileNotFoundException($settingsFullFileName);
        }

        parent::save();
        return $nbRead;
    }

    /**
     * Load `.settings-<APP_ENV>` file in given directory.
     *
     * @return int
     */
    protected function loadSettings($settingsFullFileName)
    {
        $cnt = 0;

        $this->ensureFileIsReadable($settingsFullFileName);

        $lines = $this->readLinesFromFile($settingsFullFileName);
        foreach ($lines as $line) {
            if (!$this->isComment($line) && $this->looksLikeSetter($line)) {
                $cnt = $cnt + $this->setSettingsVariable($line);
            }
        }

        return $cnt;
    }

    /**
     * Ensures the given filePath is readable.
     *
     * @throws \Dotenv\Exception\InvalidPathException
     *
     * @return void
     */
    protected function ensureFileIsReadable($settingsFullFileName)
    {
        if (!is_readable($settingsFullFileName) || !is_file($settingsFullFileName)) {
            throw new InvalidPathException(sprintf('Unable to read the environment file at %s.', $settingsFullFileName));
        }
    }

    /**
     * Read lines from the file, auto detecting line endings.
     *
     * @param string $filePath
     *
     * @return array
     */
    protected function readLinesFromFile($filePath)
    {
        // Read file into an array of lines with auto-detected line endings
        $autodetect = ini_get('auto_detect_line_endings');
        ini_set('auto_detect_line_endings', '1');
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        ini_set('auto_detect_line_endings', $autodetect);

        return $lines;
    }

    /**
     * Determine if the line in the file is a comment, e.g. begins with a #.
     *
     * @param string $line
     *
     * @return bool
     */
    protected function isComment($line)
    {
        return strpos(ltrim($line), '#') === 0;
    }

    /**
     * Determine if the given line looks like it's setting a variable.
     *
     * @param string $line
     *
     * @return bool
     */
    protected function looksLikeSetter($line)
    {
        return strpos($line, '=') !== false;
    }

    protected function setSettingsVariable($name, $value = null)
    {
        $cnt = 0;

        list($name, $value) = $this->normaliseEnvironmentVariable($name, $value);

        if ((!$this->filterDangerousSettings($name)) && (!Settings::has($name))) {
            Settings::set($name, $value);
            $cnt  = 1;
        }

        return $cnt;
    }

    /**
     * Normalise the given environment variable.
     *
     * Takes value as passed in by developer and:
     * - ensures we're dealing with a separate name and value, breaking apart the name string if needed,
     * - cleaning the value of quotes,
     * - cleaning the name of quotes,
     * - resolving nested variables.
     *
     * @param string $name
     * @param string $value
     *
     * @return array
     */
    protected function normaliseEnvironmentVariable($name, $value)
    {
        list($name, $value) = $this->splitCompoundStringIntoParts($name, $value);
        list($name, $value) = $this->sanitiseVariableName($name, $value);
        list($name, $value) = $this->sanitiseVariableValue($name, $value);

        $value = $this->resolveNestedVariables($value);

        return array($name, $value);
    }

    /**
     * Split the compound string into parts.
     *
     * If the `$name` contains an `=` sign, then we split it into 2 parts, a `name` & `value`
     * disregarding the `$value` passed in.
     *
     * @param string $name
     * @param string $value
     *
     * @return array
     */
    protected function splitCompoundStringIntoParts($name, $value)
    {
        if (strpos($name, '=') !== false) {
            list($name, $value) = array_map('trim', explode('=', $name, 2));
        }

        return array($name, $value);
    }

    /**
     * Strips quotes and the optional leading "export " from the environment variable name.
     *
     * @param string $name
     * @param string $value
     *
     * @return array
     */
    protected function sanitiseVariableName($name, $value)
    {
        $name = trim(str_replace(array('export ', '\'', '"'), '', $name));

        return array($name, $value);
    }

    /**
     * Strips quotes from the environment variable value.
     *
     * @param string $name
     * @param string $value
     *
     * @throws \Dotenv\Exception\InvalidFileException
     *
     * @return array
     */
    protected function sanitiseVariableValue($name, $value)
    {
        $value = trim($value);
        if (!$value) {
            return array($name, $value);
        }

        if ($this->beginsWithAQuote($value)) { // value starts with a quote
            $quote = $value[0];
            $regexPattern = sprintf(
                '/^
                %1$s          # match a quote at the start of the value
                (             # capturing sub-pattern used
                 (?:          # we do not need to capture this
                  [^%1$s\\\\] # any character other than a quote or backslash
                  |\\\\\\\\   # or two backslashes together
                  |\\\\%1$s   # or an escaped quote e.g \"
                 )*           # as many characters that match the previous rules
                )             # end of the capturing sub-pattern
                %1$s          # and the closing quote
                .*$           # and discard any string after the closing quote
                /mx',
                $quote
            );
            $value = preg_replace($regexPattern, '$1', $value);
            $value = str_replace("\\$quote", $quote, $value);
            $value = str_replace('\\\\', '\\', $value);
        } else {
            $parts = explode(' #', $value, 2);
            $value = trim($parts[0]);

            // Unquoted values cannot contain whitespace
            if (preg_match('/\s+/', $value) > 0) {
                throw new InvalidFileException('Dotenv values containing spaces must be surrounded by quotes.');
            }
        }

        return array($name, trim($value));
    }

    /**
     * Determine if the given string begins with a quote.
     *
     * @param string $value
     *
     * @return bool
     */
    protected function beginsWithAQuote($value)
    {
        return strpbrk($value[0], '"\'') !== false;
    }

    /**
     * Resolve the nested variables.
     *
     * Look for {$varname} patterns in the variable value and replace with an
     * existing environment variable.
     *
     * @param string $value
     *
     * @return mixed
     */
    protected function resolveNestedVariables($value)
    {
        if (strpos($value, '$') !== false) {
            $loader = $this;
            $value = preg_replace_callback(
                '/\${([a-zA-Z0-9_]+)}/',
                function ($matchedPatterns) use ($loader) {
                    $nestedVariable = Settings::get($matchedPatterns[1]);
                    if ($nestedVariable === null) {
                        return $matchedPatterns[0];
                    } else {
                        return $nestedVariable;
                    }
                },
                $value
            );
        }

        return $value;
    }

    protected function filterDangerousSettings($name)
    {
        $filterOutList = config('settings.filter_out');

        foreach ($filterOutList as $item) {
            if (preg_match($item, $name)) {
                return true;
            }
        }

        return false;
    }

}
