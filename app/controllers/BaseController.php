<?php

class BaseController extends Controller {

	protected $layout = 'layout';

    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }

        $this->layout->title = '';

        $this->layout->header = View::make('header.layout', array(
            'logoTitle' => 'trueface',
        ));

        $this->layout->footer = View::make('footer.layout', array(

        ));

    }

}