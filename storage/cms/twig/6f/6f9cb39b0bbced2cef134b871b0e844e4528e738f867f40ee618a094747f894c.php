<?php

/* /usr/share/nginx/html/themes/demo/partials/site/js_comment.htm */
class __TwigTemplate_b7bc71255ffa204928eaa46d5d2a33960498c4af4060d2150520fcc66816331f extends Twig_Template
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
        if (($context["hasComment"] ?? null)) {
            // line 2
            echo "<script src=\"";
            echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/comment.js");
            echo "\"></script>
";
        }
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/partials/site/js_comment.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if hasComment %}
<script src=\"{{ 'assets/javascript/comment.js'|theme }}\"></script>
{% endif %}", "/usr/share/nginx/html/themes/demo/partials/site/js_comment.htm", "");
    }
}
