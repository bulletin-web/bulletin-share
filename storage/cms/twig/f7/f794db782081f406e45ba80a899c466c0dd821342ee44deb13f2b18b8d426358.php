<?php

/* /usr/share/nginx/html/themes/demo/partials/site/js_custom.htm */
class __TwigTemplate_315e1e3a499e9ad1ac58bdfb249fb1826c37f692148cb57ba3b08745020802ed extends Twig_Template
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
        if (($context["hasPreview"] ?? null)) {
            // line 2
            echo "<script src=\"";
            echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/custom.js");
            echo "\"></script>
";
        }
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/partials/site/js_custom.htm";
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
        return new Twig_Source("{% if hasPreview %}
<script src=\"{{ 'assets/javascript/custom.js'|theme }}\"></script>
{% endif %}", "/usr/share/nginx/html/themes/demo/partials/site/js_custom.htm", "");
    }
}
