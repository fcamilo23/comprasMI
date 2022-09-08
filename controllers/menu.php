<?php
class Menu extends Controller{
	protected function homeUser(){
		$viewmodel = new MenuModel();
		$this->returnView($viewmodel->homeUser(), true);
	}

    protected function home(){
		$viewmodel = new MenuModel();
		$this->returnView($viewmodel->home(), true);
	}
}