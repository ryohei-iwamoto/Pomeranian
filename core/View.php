<?php

class View
{
    protected $base_dir;
    protected $defaults_vals;
    protected $layout_variables = array();

    public function __construct($base_dir, $defaults_vals=array())
    {
        $this->base_dir = $base_dir;
        $this->defaults_vals = $defaults_vals;
    }

    public function setLayoutVar($name, $value)
    {
        $this->layout_variables[$name] = $value;
    }

//    extractで展開した時に変数のバッティングが起きないように_を付けるようにしている
    public function render($_path, $_variables=array(), $_layout=false)
    {
        $_file = $this->base_dir . "/" . $_path . ".php";
        extract(array_merge($this->defaults_vals, $_variables));

        ob_start();
        ob_implicit_flush(false);

        require $_file;

        $content = ob_get_clean();
        if ($_layout) {
            $content = $this->render($_layout,
                array_merge($this->layout_variables, array(
                        '_content' => $content
                    )
                ));
        }
        return $content;
    }

    public function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}