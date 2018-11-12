<?php

/* /usr/share/nginx/html/themes/demo/partials/site/social.htm */
class __TwigTemplate_b2d428368875d9de42afbe24f67a5c8e598e131f62e8f9b787c65580f360a3a4 extends Twig_Template
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
        if ((twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "accept_facebook", array()) || twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "accept_twitter", array()))) {
            // line 2
            echo "<div class=\"social-block\">
\t";
            // line 3
            if (twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "accept_facebook", array())) {
                // line 4
                echo "\t\t<div class=\"fb-share-button\" data-href=\"";
                echo url("/blog/post/");
                echo "/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["post"] ?? null), "slug", array()), "html", null, true);
                echo "\" data-layout=\"button\" data-size=\"large\" data-mobile_iframe=\"true\">
\t\t\t<a class=\"fb-xfbml-parse-ignore\"
\t\t\t   target=\"_blank\"
\t\t\t   href=\"https://www.facebook.com/sharer/sharer.php?u=";
                // line 7
                echo url("/blog/post/");
                echo "/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["post"] ?? null), "slug", array()), "html", null, true);
                echo "&amp;src=sdkpreparse\">Share Facebook</a>
\t\t</div>
\t";
            }
            // line 10
            echo "\t";
            if (twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "accept_twitter", array())) {
                // line 11
                echo "\t\t<a href=\"";
                echo url("/blog/post/");
                echo "/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["post"] ?? null), "slug", array()), "html", null, true);
                echo "\"
\t\t   class=\"twitter-share-button\"
\t\t   data-size=\"large\"
\t\t   data-show-count=\"false\">Tweet</a>
\t\t<script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>
\t";
            }
            // line 17
            echo "</div>
";
        }
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/partials/site/social.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 17,  46 => 11,  43 => 10,  35 => 7,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if demoSettings.infoSetting.accept_facebook or demoSettings.infoSetting.accept_twitter %}
<div class=\"social-block\">
\t{% if demoSettings.infoSetting.accept_facebook %}
\t\t<div class=\"fb-share-button\" data-href=\"{{ url('/blog/post/') }}/{{ post.slug }}\" data-layout=\"button\" data-size=\"large\" data-mobile_iframe=\"true\">
\t\t\t<a class=\"fb-xfbml-parse-ignore\"
\t\t\t   target=\"_blank\"
\t\t\t   href=\"https://www.facebook.com/sharer/sharer.php?u={{ url('/blog/post/') }}/{{ post.slug }}&amp;src=sdkpreparse\">Share Facebook</a>
\t\t</div>
\t{% endif %}
\t{% if demoSettings.infoSetting.accept_twitter %}
\t\t<a href=\"{{ url('/blog/post/') }}/{{ post.slug }}\"
\t\t   class=\"twitter-share-button\"
\t\t   data-size=\"large\"
\t\t   data-show-count=\"false\">Tweet</a>
\t\t<script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>
\t{% endif %}
</div>
{% endif %}", "/usr/share/nginx/html/themes/demo/partials/site/social.htm", "");
    }
}
