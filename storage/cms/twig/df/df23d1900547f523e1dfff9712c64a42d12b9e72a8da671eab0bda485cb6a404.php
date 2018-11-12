<?php

/* /usr/share/nginx/html/themes/demo/partials/site/new-header.htm */
class __TwigTemplate_7309f81fa5aa2a9ca7d738c8cc53bc947bb09c9c85ced2001aedff988fb1e244 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"container\" style=\"padding: 0px !important;\">
    <div id=\"nav-sm\"><div id=\"nav-sm-content\">
        <ul></ul>
    </div></div>
    ";
        // line 5
        if (twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "searchable", array())) {
            // line 6
            echo "    ";
            if ((($context["hasPreview"] ?? null) != true)) {
                // line 7
                echo "    ";
                echo call_user_func_array($this->env->getFunction('form_open')->getCallable(), array("open", array("class" => "search-form", "request" => "onHandleForm", "url" => "/blog/search/")));
                echo "
    <div class=\"input-group custom_width_setting\">
        <input type=\"text\" class=\"form-control\" id=\"text_keyword_search\" name=\"search\" placeholder=\"記事検索\" value=\"";
                // line 9
                echo twig_escape_filter($this->env, ($context["search"] ?? null), "html", null, true);
                echo "\">
        <div class=\"input-group-addon\">
            <button type=\"submit\"><i class=\"ico-magnifier\"></i></button>
        </div>
    </div>
    ";
                // line 14
                echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), array("close"));
                echo "
    ";
            }
            // line 16
            echo "    ";
        }
        // line 17
        echo "
    <div class=\"header\">
        <span class=\"nav-sm-btn\">
            <span class=\"line-1\"></span>
            <span class=\"line-2\"></span>
            <span class=\"line-3\"></span>
        </span>
        <a href=\"";
        // line 24
        echo ((($context["hasPreview"] ?? null)) ? ("javascript:;") : ("/"));
        echo "\" class=\"logo\" title=\"Blog\">
            <img src=\"https://prost.hutec.info/storage/app/media/1519727596.logo.png\" alt=\"\">
        </a>
        ";
        // line 27
        if ((($context["hasPreview"] ?? null) != true)) {
            // line 28
            echo "        <span class=\"search-sm-btn\" style=\"background: #0089CF;\">
\t\t<i class=\"ico-magnifier\"></i>
\t\t</span>
        ";
        }
        // line 32
        echo "    </div>
</div></header>";
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/partials/site/new-header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 32,  69 => 28,  67 => 27,  61 => 24,  52 => 17,  49 => 16,  44 => 14,  36 => 9,  30 => 7,  27 => 6,  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"container\" style=\"padding: 0px !important;\">
    <div id=\"nav-sm\"><div id=\"nav-sm-content\">
        <ul></ul>
    </div></div>
    {% if demoSettings.infoSetting.searchable %}
    {% if hasPreview != true %}
    {{ form_open({ class: 'search-form', request: 'onHandleForm', url: '/blog/search/' }) }}
    <div class=\"input-group custom_width_setting\">
        <input type=\"text\" class=\"form-control\" id=\"text_keyword_search\" name=\"search\" placeholder=\"記事検索\" value=\"{{ search }}\">
        <div class=\"input-group-addon\">
            <button type=\"submit\"><i class=\"ico-magnifier\"></i></button>
        </div>
    </div>
    {{ form_close() }}
    {% endif %}
    {% endif %}

    <div class=\"header\">
        <span class=\"nav-sm-btn\">
            <span class=\"line-1\"></span>
            <span class=\"line-2\"></span>
            <span class=\"line-3\"></span>
        </span>
        <a href=\"{{ hasPreview ? 'javascript:;' : '/' }}\" class=\"logo\" title=\"Blog\">
            <img src=\"https://prost.hutec.info/storage/app/media/1519727596.logo.png\" alt=\"\">
        </a>
        {% if hasPreview != true %}
        <span class=\"search-sm-btn\" style=\"background: #0089CF;\">
\t\t<i class=\"ico-magnifier\"></i>
\t\t</span>
        {% endif %}
    </div>
</div></header>", "/usr/share/nginx/html/themes/demo/partials/site/new-header.htm", "");
    }
}
