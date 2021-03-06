<?phpabstract class Form{	protected $data;		public function __construct()	{		$this->logger = logger::getRootlogger();	}		public function __set($key, $val)	{		$key=strtolower($key);		$this->data[$key]=$val;	}	public function __get($key)	{		$key=strtolower($key);		return $this->data[$key];	}		public function formaction()	{		if($this->data["enctype"])			$frmact="id=\"".$this->name."\" action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\"";		else			$frmact="id=\"".$this->name."\" action=\"index.php\" method=\"post\"";		return $frmact;	}		public function formhidden()	{		$str="";		if(isset($this->data["session"]))			$str.="\t\t<input name=\"session\" id=\"session\" type=\"hidden\" value=\"".$this->data["session"]."\"/>\n";		if(isset($this->data["module"]))			$str.="\t\t<input name=\"module\" id=\"module\" type=\"hidden\" value=\"".$this->data["module"]."\"/>\n";		if(isset($this->data["action"]))			$str.="\t\t<input name=\"action\" id=\"action\" type=\"hidden\" value=\"".$this->data["action"]."\"/>\n";		if(isset($this->data["key"]))			$str.="\t\t<input name=\"key\" id=\"key\" type=\"hidden\" value=\"".$this->data["key"]."\"/>\n";		return $str;	}		public function modalbox()	{		$str="";		$str.="\t<div class=\"modal hide fade\" id=\"myModal\">";		$str.="\t\t<div class=\"modal-header\">";		$str.="\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>";		$str.="<h3>".$this->data["modal_name"]."</h3>";		$str.="</div>";		return $str;	}		public abstract function pre_form();		public abstract function post_form();}/*********************************************************************************************************From creation as per Gventure standard articture *********************************************************************************************************/class FormGventure extends Form{		public function pre_form()	{		$str="<div class=\"box-header\" data-original-title=\"\">\n			\t<h2><i class=\"".$this->icon."\"></i><span class=\"break\"></span>".$this->label."</h2>\n";					if(isset($this->data["modal"]) || isset($this->data["minimize"]) || isset($this->data["remove"]))		{			$str.="\t<div class=\"box-icon\">\n";			if(isset($this->data["modal"]))				$str.="\t\t<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>\n";			if(isset($this->data["minimize"]))				$str.="\t\t<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>\n";			if(isset($this->data["remove"]))				$str.="\t\t<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>\n";			$str.="\t</div>\n";		}		$str.="</div>\n";		$str.="<div class=\"box-content\">\n";					$str.="\t<form class=\"form-horizontal\" ".$this->formaction().">\n";				$str.=$this->formhidden();		$str.="\t\t<fieldset>\n";				return $str;	}		public function post_form()	{		$str="";		$str.="\t\t</fieldset>\n";		$str.="\t</form>\n";  		$str.="</div>\n";		return $str;	}}/*********************************************************************************************************Bootstrap_Metro_Dashboard=========================A Metro Style Dashboard Template with Twitter BootstrapDemo: http://jiji262.github.io/Bootstrap_Metro_Dashboard/**NOTE:** Please remember to **STAR** this project and **FOLLOW** [my Github](https://github.com/jiji262) to keep you update with this template.Description----------------------------This template is based on Twitter bootstrap and metro-bootstrap style, jQuery 1.9.1 and jQuery UI are used.http://twitter.github.io/bootstrap/http://talkslab.github.io/metro-bootstrap/*********************************************************************************************************/class FormMetro extends Form{		public function pre_form()	{		$str="<div class=\"box-header\" data-original-title=\"\">\n			\t<h2><i class=\"".$this->icon."\"></i><span class=\"break\"></span>".$this->label."</h2>\n";					if(isset($this->data["modal"]) || isset($this->data["minimize"]) || isset($this->data["remove"]))		{			$str.="\t<div class=\"box-icon\">\n";			if(isset($this->data["modal"]))				$str.="\t\t<a href=\"#\" class=\"btn-setting\"><i class=\"halflings-icon wrench\"></i></a>\n";			if(isset($this->data["minimize"]))				$str.="\t\t<a href=\"#\" class=\"btn-minimize\"><i class=\"halflings-icon chevron-up\"></i></a>\n";			if(isset($this->data["remove"]))				$str.="\t\t<a href=\"#\" class=\"btn-close\"><i class=\"halflings-icon remove\"></i></a>\n";			$str.="\t</div>\n";		}		$str.="</div>\n";		$str.="<div class=\"box-content\">\n";					$str.="\t<form class=\"form-horizontal\" ".$this->formaction().">\n";				$str.=$this->formhidden();		$str.="\t\t<fieldset>\n";				return $str;	}		public function post_form()	{		$str="";		$str.="\t\t</fieldset>\n";		$str.="\t</form>\n";  		$str.="</div>\n";		return $str;	}}?>