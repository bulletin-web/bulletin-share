<?php

/* /usr/share/nginx/html/themes/demo/partials/site/menu-bar.htm */
class __TwigTemplate_83c55d027439a7259fd822b5e49616f9ac7b64f2d0d5bd72b84909c092232411 extends Twig_Template
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
        echo "<!--<div class=\"container line\" style=\"background-color: red;height: 3px;margin-bottom: 2px\"></div>-->
<div class=\"container\">
    ";
        // line 3
        $context["globalMenu"] = twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getGlobalMenu", array(), "method");
        // line 4
        echo "    ";
        if (($context["globalMenu"] ?? null)) {
            // line 5
            echo "    <ul>
        ";
            // line 6
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["globalMenu"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
                // line 7
                echo "        ";
                if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method")) {
                    // line 8
                    echo "        <li class=\"cate-link ";
                    if ((($context["active"] ?? null) == twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method"))) {
                        echo " active ";
                    }
                    echo "\">
            <div class=\"line\" style=\"background-color: ";
                    // line 9
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuColor", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method"), "html", null, true);
                    echo ";\"></div>
            <a href=\"";
                    // line 10
                    echo twig_escape_filter($this->env, ((($context["hasPreview"] ?? null)) ? ("javascript:;") : (twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method"))), "html", null, true);
                    echo "\"
               title=\"";
                    // line 11
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuName", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method"), "html", null, true);
                    echo "\">";
                    echo call_user_func_array($this->env->getFunction('str_limit')->getCallable(), array("limit", twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuName", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(),                     // line 12
$context["menu"], "id", array())), "method"), 20));
                    echo "</a>
        </li>
        ";
                }
                // line 15
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "    </ul>
    ";
        }
        // line 18
        echo "    <div class=\"dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"dropdown01\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
           aria-expanded=\"false\">
            <span class=\"dot-1\"></span>
            <span class=\"dot-2\"></span>
            <span class=\"dot-3\"></span>
        </a>
        ";
        // line 25
        $context["subMenu"] = twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getSubMenu", array(), "method");
        // line 26
        echo "        ";
        if (($context["subMenu"] ?? null)) {
            // line 27
            echo "        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdown01\">
            ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["subMenu"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["menu"]) {
                // line 29
                echo "            ";
                if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method")) {
                    // line 30
                    echo "            <li><a class=\"dropdown-item\" href=\"";
                    echo twig_escape_filter($this->env, ((($context["hasPreview"] ?? null)) ? ("javascript:;") : (twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method"))), "html", null, true);
                    echo "\">";
                    echo call_user_func_array($this->env->getFunction('str_limit')->getCallable(), array("limit", twig_get_attribute($this->env, $this->getSourceContext(),                     // line 31
($context["blogMenu"] ?? null), "getMenuName", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["menu"], "id", array())), "method"), 20));
                    echo "</a></li>
            ";
                }
                // line 33
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "        </ul>
        ";
        }
        // line 36
        echo "    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/partials/site/menu-bar.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 36,  111 => 34,  105 => 33,  100 => 31,  96 => 30,  93 => 29,  89 => 28,  86 => 27,  83 => 26,  81 => 25,  72 => 18,  68 => 16,  62 => 15,  56 => 12,  53 => 11,  49 => 10,  45 => 9,  38 => 8,  35 => 7,  31 => 6,  28 => 5,  25 => 4,  23 => 3,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!--<div class=\"container line\" style=\"background-color: red;height: 3px;margin-bottom: 2px\"></div>-->
<div class=\"container\">
    {% set globalMenu = blogMenu.getGlobalMenu() %}
    {% if globalMenu %}
    <ul>
        {% for menu in globalMenu %}
        {% if blogMenu.getMenuLink(menu.type, menu.id) %}
        <li class=\"cate-link {% if active == blogMenu.getMenuLink(menu.type, menu.id) %} active {% endif %}\">
            <div class=\"line\" style=\"background-color: {{ blogMenu.getMenuColor(menu.type, menu.id) }};\"></div>
            <a href=\"{{ hasPreview ? 'javascript:;' : blogMenu.getMenuLink(menu.type, menu.id) }}\"
               title=\"{{ blogMenu.getMenuName(menu.type, menu.id) }}\">{{ str_limit(blogMenu.getMenuName(menu.type,
                menu.id), 20) }}</a>
        </li>
        {% endif %}
        {% endfor %}
    </ul>
    {% endif %}
    <div class=\"dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"dropdown01\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
           aria-expanded=\"false\">
            <span class=\"dot-1\"></span>
            <span class=\"dot-2\"></span>
            <span class=\"dot-3\"></span>
        </a>
        {% set subMenu = blogMenu.getSubMenu() %}
        {% if subMenu %}
        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdown01\">
            {% for menu in subMenu %}
            {% if blogMenu.getMenuLink(menu.type, menu.id) %}
            <li><a class=\"dropdown-item\" href=\"{{ hasPreview ? 'javascript:;' : blogMenu.getMenuLink(menu.type, menu.id) }}\">{{
                str_limit(blogMenu.getMenuName(menu.type, menu.id), 20) }}</a></li>
            {% endif %}
            {% endfor %}
        </ul>
        {% endif %}
    </div>
</div>", "/usr/share/nginx/html/themes/demo/partials/site/menu-bar.htm", "");
    }
}
