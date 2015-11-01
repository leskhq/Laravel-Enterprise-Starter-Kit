<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Auth;

use App\Repositories\AuditRepository as Audit;

class TestController extends Controller
{

    public function flash_success()
    {
        $tmp = Audit::log(Auth::user()->id, "flash_test", "Testing audit with flash success.");

        $page_title = "Flash test";
        $page_description = "Testing the flash mechanism with a success level";

        Flash::success('This is a success message!');

        return view('flash_test', compact('page_title', 'page_description'));
    }

    public function flash_info()
    {
        $page_title = "Flash test";
        $page_description = "Testing the flash mechanism with an info level";

        Flash::info('This is an info message!');

        return view('flash_test', compact('page_title', 'page_description'));
    }

    public function flash_warning()
    {
        $page_title = "Flash test";
        $page_description = "Testing the flash mechanism with a warning level";

        Flash::warning('This is a warning message!');

        return view('flash_test', compact('page_title', 'page_description'));
    }

    public function flash_error()
    {
        $page_title = "Flash test";
        $page_description = "Testing the flash mechanism with a error level";

        Flash::error('This is an error message!');

        return view('flash_test', compact('page_title', 'page_description'));
    }

    public function acl_test_do_not_load()
    {
        $page_title = "ACL test";
        $page_description = "Testing the ACL mechanism.";
        $page_message = "This route should not be loaded into the list of application routes.";

        return view('acl_test', compact('page_title', 'page_description', 'page_message'));
    }

    public function acl_test_no_perm()
    {
        $page_title = "ACL test";
        $page_description = "Testing the ACL mechanism.";
        $page_message = "This route does not have any permission assigned to it.";

        return view('acl_test', compact('page_title', 'page_description', 'page_message'));
    }

    public function acl_test_basic_authenticated()
    {
        $page_title = "ACL test";
        $page_description = "Testing the ACL mechanism.";
        $page_message = "This route requires basic-authenticated perms.";

        return view('acl_test', compact('page_title', 'page_description', 'page_message'));
    }

    public function acl_test_guest_only()
    {
        $page_title = "ACL test";
        $page_description = "Testing the ACL mechanism.";
        $page_message = "This route requires guest-only perms.";

        return view('acl_test', compact('page_title', 'page_description', 'page_message'));
    }

    public function acl_test_open_to_all()
    {
        $page_title = "ACL test";
        $page_description = "Testing the ACL mechanism.";
        $page_message = "This route requires open-to-all perms.";

        return view('acl_test', compact('page_title', 'page_description', 'page_message'));
    }

    public function acl_test_admins()
    {
        $page_title = "ACL test";
        $page_description = "Testing the ACL mechanism.";
        $page_message = "This route requires admins perms.";

        return view('acl_test', compact('page_title', 'page_description', 'page_message'));
    }

    public function acl_test_power_users()
    {
        $page_title = "ACL test";
        $page_description = "Testing the ACL mechanism.";
        $page_message = "This route requires power-users perms.";

        return view('acl_test', compact('page_title', 'page_description', 'page_message'));
    }


}
