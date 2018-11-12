<?php

/* /usr/share/nginx/html/themes/demo/partials/site/new-footer.htm */
class __TwigTemplate_5a5a7a89d880fa52718116a05fb9cddad3d50ef8f8c7fc7fdfabc1d328d38720 extends Twig_Template
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
        echo "<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            ";
        // line 4
        $context["footerMenu"] = twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getFooterMenu", array(), "method");
        // line 5
        echo "            ";
        if (($context["footerMenu"] ?? null)) {
            // line 6
            echo "            <ul class=\"fLink\">
                ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["footerMenu"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
                // line 8
                echo "                ";
                if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method")) {
                    // line 9
                    echo "                <li><a href=\"";
                    echo twig_escape_filter($this->env, ((($context["hasPreview"] ?? null)) ? ("javascript:;") : (twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method"))), "html", null, true);
                    echo "\">";
                    echo call_user_func_array($this->env->getFunction('str_limit')->getCallable(), array("limit", twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuName", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method"), 20));
                    echo "</a></li>
                ";
                }
                // line 11
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "            </ul>
            ";
        }
        // line 14
        echo "        </div>
        <div class=\"col-md-12\">
            <a href=\"";
        // line 16
        echo ((($context["hasPreview"] ?? null)) ? ("javascript:;") : ("/"));
        echo "\" class=\"fLogo\">
                <img src=\"https://prost.hutec.info/storage/app/media/1519727596.logo.png\" alt=\"\">
            </a>
            <p class=\"copyright\">";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "copyright", array()), "html", null, true);
        echo "</p>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/partials/site/new-footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 19,  61 => 16,  57 => 14,  53 => 12,  47 => 11,  39 => 9,  36 => 8,  32 => 7,  29 => 6,  26 => 5,  24 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            {% set footerMenu = blogMenu.getFooterMenu() %}
            {% if footerMenu %}
            <ul class=\"fLink\">
                {% for menu in footerMenu %}
                {% if blogMenu.getMenuLink(menu.type, menu.id) %}
                <li><a href=\"{{ hasPreview ? 'javascript:;' : blogMenu.getMenuLink(menu.type, menu.id) }}\">{{ str_limit(blogMenu.getMenuName(menu.type, menu.id), 20) }}</a></li>
                {% endif %}
                {% endfor %}
            </ul>
            {% endif %}
        </div>
        <div class=\"col-md-12\">
            <a href=\"{{ hasPreview ? 'javascript:;' : '/' }}\" class=\"fLogo\">
                <img src=\"https://prost.hutec.info/storage/app/media/1519727596.logo.png\" alt=\"\">
            </a>
            <p class=\"copyright\">{{ demoSettings.infoSetting.copyright }}</p>
        </div>
    </div>
</div>", "/usr/share/nginx/html/themes/demo/partials/site/new-footer.htm", "");
    }
}
