<?php

namespace AshAllenDesign\ShortURL\Tests\Unit\Classes;

use AshAllenDesign\ShortURL\Classes\Validation;
use AshAllenDesign\ShortURL\Exceptions\ValidationException;
use AshAllenDesign\ShortURL\Tests\Unit\TestCase;
use Illuminate\Support\Facades\Config;

class ValidationTest extends TestCase
{
    /** @test */
    public function exception_is_thrown_if_the_key_length_is_not_an_integer()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The config URL length is not a valid integer.');

        Config::set('short-url.key_length', 'INVALID');

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_key_length_is_below_3()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The config URL length must be 3 or above.');

        Config::set('short-url.key_length', 2);

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_default_enabled_variable_is_not_a_boolean()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The default_enabled config variable must be a boolean.');

        Config::set('short-url.tracking.default_enabled', 'INVALID');

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_any_of_the_tracking_options_are_not_null()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The ip_address config variable must be a boolean.');

        Config::set('short-url.tracking.fields.ip_address', 'INVALID');

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_disable_default_route_option_is_not_a_boolean()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The disable_default_route config variable must be a boolean.');

        Config::set('short-url.disable_default_route', 'INVALID');

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_key_salt_is_not_a_string()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The config key salt must be a string.');

        Config::set('short-url.key_salt', true);

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_key_salt_is_less_than_one_character_long()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The config key salt must be at least 1 character long.');

        Config::set('short-url.key_salt', '');

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_enforce_https_variable_is_not_a_boolean()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The enforce_https config variable must be a boolean.');

        Config::set('short-url.enforce_https', 'INVALID');

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_forward_query_params_variable_is_not_a_boolean()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The forward_query_params config variable must be a boolean.');

        Config::set('short-url.forward_query_params', 'INVALID');

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_default_url_is_not_a_string(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The default_url config variable must be a string or null.');

        Config::set('short-url.default_url', true);

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_default_redirect_status_code_params_variable_is_not_an_integer()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The default_redirect_status_code config variable must be a 301, 302, 303, 307, 308, or null.');

        Config::set('short-url.default_redirect_status_code', 'INVALID');

        $validation = new Validation();
        $validation->validateConfig();
    }

    public function exception_is_thrown_if_the_default_short_urls_table_name_params_variable_is_not_a_valid_string_or_null()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The default_short_urls_table config variable must be a string or null.');

        Config::set('short-url.default_short_urls_table', -100);

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function exception_is_thrown_if_the_default_redirect_status_code_params_variable_is_not_a_valid_redirect_http_status_code()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The default_redirect_status_code config variable must be a 301, 302, 303, 307, 308, or null.');

        Config::set('short-url.default_redirect_status_code', -100);

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function config_validation_passes_if_the_default_redirect_status_code_params_variable_is_null()
    {
        Config::set('short-url.default_redirect_status_code', null);

        $validation = new Validation();

        try {
            $this->assertTrue($validation->validateConfig());
        } catch (\Exception $exception) {
            $this->fail('validateConfig unexpectedly threw an exception when it should have returned true');
        }
    }

    public function config_validation_passes_if_the_default_short_urls_table_name_params_variable_is_null()
    {
        Config::set('short-url.default_short_urls_table', null);

        $validation = new Validation();

        try {
            $this->assertTrue($validation->validateConfig());
        } catch (\Exception $exception) {
            $this->fail('validateConfig unexpectedly threw an exception when it should have returned true');
        }
    }

    /** @test */
    public function exception_is_thrown_if_the_default_short_url_visits_table_name_params_variable_is_not_a_valid_string_or_null()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The default_short_url_visits_table config variable must be a string or null.');

        Config::set('short-url.default_short_url_visits_table', -100);

        $validation = new Validation();
        $validation->validateConfig();
    }

    /** @test */
    public function config_validation_passes_if_the_default_short_url_visits_table_name_params_variable_is_null()
    {
        Config::set('short-url.default_short_url_visits_table', null);

        $validation = new Validation();

        try {
            $this->assertTrue($validation->validateConfig());
        } catch (\Exception $exception) {
            $this->fail('validateConfig unexpectedly threw an exception when it should have returned true');
        }
    }
}
