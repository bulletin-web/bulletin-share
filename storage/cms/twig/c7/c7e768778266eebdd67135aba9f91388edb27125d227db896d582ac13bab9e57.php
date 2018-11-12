<?php

/* /usr/share/nginx/html/themes/demo/layouts/blog-layout.htm */
class __TwigTemplate_08ea92237fc8cbd3738c041cc75a2998843b0498f49cc108fbe2cd01c333fff6 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"jp\">
<head>
    <!--<link rel=\"shortcut icon\" sizes=\"32x32\" href=\"./images/common/favicon32x32.png\">-->
    <!--<link rel=\"icon\" sizes=\"64x64\" href=\"./images/common/favicon64x64.png\">-->
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta itemprop=\"keywords\" name=\"keywords\" content=\"\"/>
    <meta itemprop=\"description\" name=\"description\" content=\"\"/>
    <meta property=\"og:title\" content=\"\"/>
    <meta property=\"og:description\" content=\"\"/>
    <meta property=\"og:image:width\" content=\"1200\"/>
    <meta property=\"og:image:height\" content=\"630\"/>
    <meta property=\"og:image:width\" content=\"200\"/>
    <meta property=\"og:image:height\" content=\"200\"/>
    <meta property=\"og:site_name\" content=\"\"/>
    <meta property=\"og:country-name\" content=\"Japan\"/>
    <title>";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "site_name", array()), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "title", array()), "html", null, true);
        echo "</title>

    <!-- Bootstrap CSS -->
    <link rel=\"stylesheet\" href=\"";
        // line 22
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/bootstrap/css/bootstrap.min.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 23
        echo "/modules/backend/formwidgets/richeditor/assets/css/richeditor.css?v1";
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 24
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/slick/slick.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 25
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/css/common.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 26
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/css/common_custom.css");
        echo "\">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->

    ";
        // line 35
        if (twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "access_analysis_tag", array())) {
            // line 36
            echo "    ";
            echo twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "infoSetting", array()), "access_analysis_tag", array());
            echo "
    ";
        }
        // line 38
        echo "</head>
<body>

<div id=\"fb-root\"></div>
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1971597273097534';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header>
    ";
        // line 52
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/new-header"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 53
        echo "</header>
<nav class=\"global-category\" id=\"global-category\" style=\"background: ";
        // line 54
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "displaySetting", array()), "menu_color", array()), "html", null, true);
        echo ";\">
    ";
        // line 55
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/menu-bar"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 56
        echo "</nav>
<!-- Content -->
<div style=\"min-height: 69%\" id=\"main\">
    ";
        // line 59
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 60
        echo "</div>

<footer>
    ";
        // line 63
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/new-footer"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 64
        echo "</footer>
<!-- jQuery -->
<script src=\"";
        // line 66
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/jquery/jquery.min.js");
        echo "\"></script>
<!-- Bootstrap JavaScript -->
<script src=\" ";
        // line 68
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/bootstrap/js/bootstrap.min.js");
        echo "\"></script>
<script src=\"";
        // line 69
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/slick/slick.min.js");
        echo "\"></script>
<script src=\"";
        // line 70
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/javascript/blog.js");
        echo "\"></script>

";
        // line 72
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/js_comment"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 73
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/js_preview"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 74
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/js_custom"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 75
        echo "<script>
    \$('#main').on('mouseenter', '.btn_tag', function () {
        var tag = \$(this);
        tag.attr('style', 'border: 1px solid '+ tag.data('color')+';');
    });
    \$('#main').on('mouseleave','.btn_tag', function () {
        var tag = \$(this);
        tag.removeAttr('style');
    });
</script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/layouts/blog-layout.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 75,  160 => 74,  156 => 73,  152 => 72,  147 => 70,  143 => 69,  139 => 68,  134 => 66,  130 => 64,  126 => 63,  121 => 60,  119 => 59,  114 => 56,  110 => 55,  106 => 54,  103 => 53,  99 => 52,  83 => 38,  77 => 36,  75 => 35,  63 => 26,  59 => 25,  55 => 24,  51 => 23,  47 => 22,  39 => 19,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"jp\">
<head>
    <!--<link rel=\"shortcut icon\" sizes=\"32x32\" href=\"./images/common/favicon32x32.png\">-->
    <!--<link rel=\"icon\" sizes=\"64x64\" href=\"./images/common/favicon64x64.png\">-->
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta itemprop=\"keywords\" name=\"keywords\" content=\"\"/>
    <meta itemprop=\"description\" name=\"description\" content=\"\"/>
    <meta property=\"og:title\" content=\"\"/>
    <meta property=\"og:description\" content=\"\"/>
    <meta property=\"og:image:width\" content=\"1200\"/>
    <meta property=\"og:image:height\" content=\"630\"/>
    <meta property=\"og:image:width\" content=\"200\"/>
    <meta property=\"og:image:height\" content=\"200\"/>
    <meta property=\"og:site_name\" content=\"\"/>
    <meta property=\"og:country-name\" content=\"Japan\"/>
    <title>{{ demoSettings.infoSetting.site_name }} - {{ this.page.title }}</title>

    <!-- Bootstrap CSS -->
    <link rel=\"stylesheet\" href=\"{{ 'assets/javascript/bootstrap/css/bootstrap.min.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ '/modules/backend/formwidgets/richeditor/assets/css/richeditor.css?v1'}}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/javascript/slick/slick.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/css/common.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/css/common_custom.css'|theme }}\">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->

    {% if demoSettings.infoSetting.access_analysis_tag %}
    {{ demoSettings.infoSetting.access_analysis_tag|raw }}
    {% endif %}
</head>
<body>

<div id=\"fb-root\"></div>
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1971597273097534';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header>
    {% partial 'site/new-header' %}
</header>
<nav class=\"global-category\" id=\"global-category\" style=\"background: {{ demoSettings.displaySetting.menu_color }};\">
    {% partial 'site/menu-bar' %}
</nav>
<!-- Content -->
<div style=\"min-height: 69%\" id=\"main\">
    {% page %}
</div>

<footer>
    {% partial 'site/new-footer' %}
</footer>
<!-- jQuery -->
<script src=\"{{ 'assets/javascript/jquery/jquery.min.js'|theme }}\"></script>
<!-- Bootstrap JavaScript -->
<script src=\" {{ 'assets/javascript/bootstrap/js/bootstrap.min.js'|theme }}\"></script>
<script src=\"{{ 'assets/javascript/slick/slick.min.js'|theme }}\"></script>
<script src=\"{{ 'assets/javascript/blog.js'|theme }}\"></script>

{% partial 'site/js_comment' %}
{% partial 'site/js_preview' %}
{% partial 'site/js_custom' %}
<script>
    \$('#main').on('mouseenter', '.btn_tag', function () {
        var tag = \$(this);
        tag.attr('style', 'border: 1px solid '+ tag.data('color')+';');
    });
    \$('#main').on('mouseleave','.btn_tag', function () {
        var tag = \$(this);
        tag.removeAttr('style');
    });
</script>
</body>
</html>", "/usr/share/nginx/html/themes/demo/layouts/blog-layout.htm", "");
    }
}
