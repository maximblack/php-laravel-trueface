<?php

class HomeController extends BaseController {

	public function showWelcomePage()
	{
        $this->layout->content = View::make('home.index');
	}

    public function dashboard() {

        $this->layout->content = "";

    }

}