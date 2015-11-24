<?php

namespace App\Services\Html;

use Illuminate\Html\HtmlBuilder as BaseHtmlBuilder;
use Form;
use Session;

class HtmlBuilder extends BaseHtmlBuilder
{
    public function flashMessage()
    {
        return (Session::has('flash_notification.message')) ? '<div class="alert -'.Session::get('flash_notification.level').'">'.Session::get('flash_notification.message').'</div>' : '';
    }

    public function error($message)
    {
        return ($message == '' ? '' : '<div class="alert -danger">'.$message.'</div>');
    }

    public function message($message)
    {
        return ($message == '' ? '' : '<div class="alert -success">'.$message.'</div>');
    }

    public function info($message, $size = '')
    {
        return ($message == '' ? '' : '<div class="alert -info '.$size.'"><span class="fa fa-info-circle"></span> '.$message.'</div>');
    }

    public function avatar($user, $class = '')
    {
        return ('<span class="avatar '.$class.'" style="background-image: url(\''.$user->present()->avatar.'\')" /></span>');
    }

    public function formButton($url, $buttonHtml, $method, $submitButtonOptions = [])
    {
        $submitButtonOptions['type'] = 'submit';
        $formOptions = ['url' => $url, 'method' => $method, 'class' =>'-form-button'];

        if (strtolower($method) == 'delete') {
            $formOptions['data-confirm'] = 'true';
        }

        return Form::open($formOptions).Form::button($buttonHtml, $submitButtonOptions).Form::close();
    }
}
