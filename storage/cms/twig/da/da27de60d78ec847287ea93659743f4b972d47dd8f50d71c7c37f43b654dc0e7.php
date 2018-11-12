<?php

/* /usr/share/nginx/html/themes/demo/partials/site/js_preview.htm */
class __TwigTemplate_d1a84aa7630890088ba39dfe318ecff9b3b9d096953acab1be28bfd0d380e0ae extends Twig_Template
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
        if (($context["hasPreviewJS"] ?? null)) {
            // line 2
            echo "<script src=\"";
            echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/preview.js");
            echo "\"></script>
";
        }
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/partials/site/js_preview.htm";
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
        return new Twig_Source("{% if hasPreviewJS %}
<script src=\"{{ 'assets/javascript/preview.js'|theme }}\"></script>
{% endif %}", "/usr/share/nginx/html/themes/demo/partials/site/js_preview.htm", "");
    }
}
