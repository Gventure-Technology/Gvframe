<?php//require_once("config/config.php");abstract class Input{	protected $data;		public function __construct()	{		$this->logger = logger::getRootlogger();		if(defined("SIZETYPE"))			$this->data["sizetype"]=SIZETYPE;		else			$this->data["sizetype"]="medium";	}		public function __set($key, $val)	{		$key=strtolower($key);		$this->data[$key]=$val;	}	public function __get($key)	{		$key=strtolower($key);		return $this->data[$key];	}		public function formlabel()	{		$html="";		if(isset($this->data["label"])){			$html="for=\"".$this->data["label"]."\" ";			if(isset($this->data["help"]))				$html.="title=\"".$this->data["help"]."\" ";			if(isset($this->data["class"]))				$html.="class=\"".$this->data["class"]."\" ";			else				$html.="class=\"control-label\" ";		}		return $html;	}		//Variables needed id name placeholder readonly class focused sizetype	public function forminput()	{		$html="";				/* foreach($this->data as $key=>$val)		{			$tmp=strtolower($key);			if($tmp=="name" || $tmp=="id" || $tmp=="placeholder" || $tmp=="readonly" || $tmp=="disabled" || $tmp=="type" || $tmp=="class" || $tmp=="sizetype" || $tmp=="autocomplete" || $tmp=="placeholder" || $tmp=="placeholder" || $tmp=="placeholder" || $tmp=="placeholder")				continue;			else				$html.="".$key."=\"".$val."\" ";		} */		if(isset($this->data["name"]))			$html.="name=\"".$this->data["name"]."\" ";					if(isset($this->data["id"]))			$html.="id=\"".$this->data["id"]."\" ";		else			$html.="id=\"".$this->data["name"]."\" ";				if(isset($this->data["placeholder"]))			$html.="placeholder=\"".$this->data["placeholder"]."\" ";					if($this->data["readonly"]=="true")			$html.="readonly=\"true\" ";				if(isset($this->data["checked"]))			$html.="checked=\"checked\" ";					if($this->data["disabled"]=="true")			$html.="disabled=\"disabled\" ";				if($this->data["type"]=="datetime")		{			if(isset($this->data["class"]))				$html.="class=\"".$this->data["class"]."\" ";			else			{				$html.="class=\"input-".$this->data["sizetype"]." datepicker\" ";			}		}		else if($this->data["type"]=="autocomplete")		{			if(isset($this->data["class"]))				$html.="class=\"".$this->data["class"]."\" ";			else			{				$html.="class=\"input-".$this->data["sizetype"]." typeahead\" ";			}		}		else if($this->data["type"]=="htmledit")		{			if(isset($this->data["class"]))				$html.="class=\"".$this->data["class"]."\" ";			else			{				$html.="class=\"cleditor\" ";			}		}		else if($this->data["type"]=="file")		{			if(isset($this->data["class"]))				$html.="class=\"".$this->data["class"]."\" ";			else			{				$html.="class=\"input-file uniform_on\" ";			}		}		else if($this->data["type"]=="submit")		{			if(isset($this->data["class"]))				$html.="class=\"".$this->data["class"]."\" ";			else			{				$html.="class=\"btn btn-primary\" value=\"".$this->data["value"]."\"";			}		}		else if($this->data["type"]=="button")		{			if(isset($this->data["class"]))				$html.="class=\"".$this->data["class"]."\" ";			else			{				$html.="class=\"btn\" ";			}		}		else if(isset($this->data["min"]))		{			if(isset($this->data["max"]))				$html.="min=\"".$this->data["min"]."\" max=\"".$this->data["max"]."\" ";			else			{				$html.="min=\"".$this->data["min"]."\"";			}		}		else		{			if(isset($this->data["class"]))				$html.="class=\"".$this->data["class"]."\" ";			else			{				if($this->data["focused"])					$html.="class=\"input-".$this->data["sizetype"]." focused\" ";				else					$html.="class=\"input-".$this->data["sizetype"]."\" ";			}		}						return $html;	}		public abstract function preparehtml($control);		public abstract function hidden();		public abstract function text();		public abstract function htmledit();		public abstract function number();		public abstract function autocomplete();		public abstract function file();		public abstract function datetime();		public abstract function password();		public abstract function textarea();		public abstract function multioption();		public abstract function multiopt();		public abstract function checkbox();		public abstract function yesno();		public abstract function radio();		public abstract function select();		public abstract function select_num();		public abstract function submit();		public abstract function button();		public abstract function label();}class InputView extends Input{	public function hidden()	{		$frm=$this->forminput();					$html="<input type=\"hidden\" ".$frm." value=\"".$this->data["value"]."\"/>\n";		return $html;	}		public function text()	{		$frm=$this->forminput();					$html="<input type=\"text\" ".$frm." value=\"".$this->data["value"]."\"/>\n";		return $html;	}		public function htmledit()	{		$frm=$this->forminput();				if(isset($this->data["rows"]))			$frm.="rows=\"".$this->data["rows"]."\" ";		else			$frm.="rows=\"4\" ";					$html="<textarea ".$frm.">".$this->data["value"]."</textarea>\n";		return $html;	}		public function autocomplete()	{		$frm=$this->forminput();				if(isset($this->data["data-items"]))			$frm.="data-items=\"".$this->data["data-items"]."\" ";		else			$frm.="data-items=\"4\" ";				if(isset($this->data["data-source"]))			$frm.="data-source=\"".$this->data["data-source"]."\" ";					$html="<input type=\"text\" ".$frm." value=\"".$this->data["value"]."\"/>\n";		return $html;	}		public function number()	{		$frm=$this->forminput();					$html="<input type=\"number\" ".$frm." value=\"".$this->data["value"]."\"/>\n";		return $html;	}		public function file()	{		$frm=$this->forminput();					$html="<input type=\"file\" ".$frm." value=\"".$this->data["value"]."\"/>\n";		return $html;	}		public function datetime()	{		$frm=$this->forminput();					$html="<input type=\"text\" ".$frm." value=\"".$this->data["value"]."\"/>\n";		return $html;	}		public function password()	{		$frm=$this->forminput();					$html="<input type=\"password\" ".$frm." value=\"".$this->data["value"]."\"/>\n";		return $html;	}		public function textarea()	{		$frm=$this->forminput();				if(isset($this->data["rows"]))			$frm.="rows=\"".$this->data["rows"]."\" ";					$html="<textarea ".$frm.">".$this->data["value"]."</textarea><br/>\n";		return $html;	}		public function multioption()	{		$frm=$this->forminput();		$opt=explode("|", $this->data["option"]);				$html="<select ".$frm.">\n";		$html.="\t<option value=\"-1\">Select One</option>\n";		foreach($opt as $val)		{			if($this->data["value"]==$val)				$html.="\t<option value=\"".$val."\" selected>".$val."</option>\n";			else				$html.="\t<option value=\"".$val."\">".$val."</option>\n";		}		$html.="</select>";		return $html;	}		public function multiopt()	{		$frm=$this->forminput();		$opt=explode("|", $this->data["option"]);				if(isset($this->data["default"]))			$default=$this->data["default"];				$html="<select ".$frm.">\n";		if(isset($default))			$html.="\t<option value=\"-1\">$default</option>\n";		else			$html.="\t<option value=\"-1\">Select One</option>\n";		foreach($opt as $val)		{			$tmp=explode("-", $val);			if($this->data["value"]==$tmp[0])				$html.="\t<option value=\"".$tmp[0]."\" selected>".$tmp[1]."</option>\n";			else				$html.="\t<option value=\"".$tmp[0]."\">".$tmp[1]."</option>\n";		}		$html.="</select>";		return $html;	}		public function checkbox()	{		$frm=$this->forminput();		if($this->data["checked"]=="true")			$frm.="checked ";				if(isset($this->data["value"]))			$frm.="value=\"".$this->data["value"]."\" ";					$html.="<input type=\"checkbox\" ".$frm."/><br/>\n";		return $html;	}		public function yesno()	{		$frm=$this->forminput();		if(isset($this->data["option"])){			if($this->data["value"]==$this->data["option"][0])				$html.="Yes<input type=\"radio\" ".$frm." value=\"".$option[0]."\" checked/>";			else				$html.="Yes<input type=\"radio\" ".$frm." value=\"".$option[0]."\"/>";			if($this->data["value"]==$this->data["option"][1])				$html.="No<input type=\"radio\" ".$frm." value=\"".$option[1]."\" checked/>\n";			else				$html.="No<input type=\"radio\" ".$frm." value=\"".$option[1]."\"/>\n";		}		else{			if(strtolower($this->data["value"])=="yes")				$html.="Yes<input type=\"radio\" ".$frm." value=\"yes\" checked/>";			else				$html.="Yes<input type=\"radio\" ".$frm." value=\"yes\"/>";			if(strtolower($this->data["value"])=="no")				$html.="No<input type=\"radio\" ".$frm." value=\"no\" checked/>\n";			else				$html.="No<input type=\"radio\" ".$frm." value=\"no\"/>\n";		}		return $html;	}		public function radio()	{		$frm=$this->forminput();		if($this->data["checked"]=="true")			$frm.="checked ";					$html.="<input type=\"radio\" ".$frm."/>";		return $html;	}		//Variables multiple size	public function select()	{		$frm=$this->forminput();		if($this->data["multiple"]=="true")		{			$frm.="multiple ";			$exptmp=explode(",", $this->data["value"]);			//print_r($exptmp);		}		if(isset($this->data["default"]))			$default=$this->data["default"];				if(isset($this->data["size"]))			$frm.="size=\"".$this->data["size"]."\" ";					if(isset($this->data["modern"]))			$frm.="data-rel=\"chosen\"";					if(isset($this->data["multiselect"]))		{			$frm.="multiple data-rel=\"chosen\"";			$exptmp=explode(",", $this->data["value"]);			//print_r($exptmp);		}		if(isset($this->data["opts"]))		{			$data=explode('|', $this->data["opts"]);					foreach($data as $val)			{				$tmp=explode('-',$val);				$db[$tmp[0]]=$tmp[1];			}		}				$html="<select ".$frm.">\n";		if(isset($default))			$html.="\t<option value=\"-1\">$default</option>\n";		else			$html.="\t<option value=\"-1\">Select One</option>\n";		if($this->data["multiple"]=="true" || $this->data["multiselect"]=="true")		{						foreach($this->data["option"] as $key=>$val)			{				if(is_array($exptmp)){					if(in_array($key,$exptmp))						$html.="\t<option value=\"".$key."\" selected>".$val."</option>\n";					else						$html.="\t<option value=\"".$key."\">".$val."</option>\n";				}else					$html.="\t<option value=\"".$key."\">".$val."</option>\n";			}		}		else		{			foreach($this->data["option"] as $key=>$val)			{				if($this->data["value"]==$key)					$html.="\t<option value=\"".$key."\" selected>".$val."</option>\n";				else					$html.="\t<option value=\"".$key."\">".$val."</option>\n";			}		}		$html.="</select>";		return $html;	}		//Variables start end step prefix suffix multiple size	public function select_num()	{		$frm=$this->forminput();		if($this->data["multiple"]=="true")			$frm.="multiple ";					if(isset($this->data["default"]))			$default=$this->data["default"];				if(isset($this->data["size"]))			$frm.="size=\"".$this->data["size"]."\" ";					$html="<select ".$frm.">\n";		if(isset($this->data["start"]) && isset($this->data["end"]) && isset($this->data["step"])){			if(isset($default))				$html.="\t<option value=\"-1\">$default</option>\n";			else				$html.="\t<option value=\"-1\">Select One</option>\n";			for($i=$this->data["start"]; $i<=$this->data["end"]; $i+=$this->data["step"])				{				if($this->data["value"]==$i){					if(isset($this->data["prefix"])){						$html.="\t<option value=\"".$i."\" selected>".$this->data["prefix"]." ".$i."</option>\n";						continue;					}					if(isset($this->data["suffix"])){						$html.="\t<option value=\"".$i."\" selected>".$i." ".$this->data["suffix"]."</option>\n";						continue;					}					$html.="\t<option value=\"".$i."\" selected>".$i."</option>\n";				}				else{					if(isset($this->data["prefix"])){						$html.="\t<option value=\"".$i."\">".$this->data["prefix"]." ".$i."</option>\n";						continue;					}					if(isset($this->data["suffix"])){						$html.="\t<option value=\"".$i."\">".$i." ".$this->data["suffix"]."</option>\n";						continue;					}					$html.="\t<option value=\"".$i."\">".$i."</option>\n";				}			}		}		else if(isset($this->data["start"]) && isset($this->data["end"])){			if(isset($default))				$html.="\t<option value=\"-1\">$default</option>\n";			else				$html.="\t<option value=\"-1\">Select One</option>\n";					for($i=$this->data["start"]; $i<=$this->data["end"]; $i++)			{				if($this->data["value"]==$i){					if(isset($this->data["prefix"])){						$html.="\t<option value=\"".$i."\" selected>".$this->data["prefix"]." ".$i."</option>\n";						continue;					}					if(isset($this->data["suffix"])){						$html.="\t<option value=\"".$i."\" selected>".$i." ".$this->data["suffix"]."</option>\n";						continue;					}					$html.="\t<option value=\"".$i."\" selected>".$i."</option>\n";				}				else{					if(isset($this->data["prefix"])){						$html.="\t<option value=\"".$i."\">".$this->data["prefix"]." ".$i."</option>\n";						continue;					}					if(isset($this->data["suffix"])){						$html.="\t<option value=\"".$i."\">".$i." ".$this->data["suffix"]."</option>\n";						continue;					}					$html.="\t<option value=\"".$i."\">".$i."</option>\n";				}			}		}		$html.="</select>";		return $html;	}		//Variables check	public function submit()	{		$html="<input type=\"submit\" ".$this->forminput()." onsubmit=\"".$this->data["check"]."\">\n";		return $html;	}		public function button()	{		$html="<input type=\"button\" ".$this->forminput().">\n";		return $html;	}		public function label()	{		$html="<label for=".$this->forminput().">".$this->data["value"]."</label>\n";		return $html;	}		public function preparehtml($control)	{		}}/*********************************************************************************************************Theme as per old standard implementation on php coding*********************************************************************************************************/class InputGventure extends InputView{		public function preparehtml($control)	{		if($this->data["type"]=="hidden")		{			$str=$control;		}		else		{			$str.="\t<label ".$this->formlabel().">".$this->label."</label>\n";			$str.="\t\t".$control."\n";		}		return $str;	}}/*********************************************************************************************************Bootstrap_Metro_Dashboard=========================A Metro Style Dashboard Template with Twitter BootstrapDemo: http://jiji262.github.io/Bootstrap_Metro_Dashboard/**NOTE:** Please remember to **STAR** this project and **FOLLOW** [my Github](https://github.com/jiji262) to keep you update with this template.Description----------------------------This template is based on Twitter bootstrap and metro-bootstrap style, jQuery 1.9.1 and jQuery UI are used.http://twitter.github.io/bootstrap/http://talkslab.github.io/metro-bootstrap/*********************************************************************************************************/class InputMetro extends InputView{		public function preparehtml($control)	{		if($this->data["type"]=="hidden")		{			$str=$control;		}		else		{			if(isset($this->data["group"]))				$str="<div class=".$this->data["group"].">\n";			else				$str="<div class=\"control-group\">\n";			$str.="\t<label ".$this->formlabel().">".$this->label."</label>\n";			if(isset($this->data["contrl"]))				$str.="\t<div class=".$this->data["contrl"].">\n";			else				$str.="\t<div class=\"controls\">\n";			$str.="\t\t".$control."\n";			$str.="\t</div>\n";			$str.="</div>\n";		}		return $str;	}}?>