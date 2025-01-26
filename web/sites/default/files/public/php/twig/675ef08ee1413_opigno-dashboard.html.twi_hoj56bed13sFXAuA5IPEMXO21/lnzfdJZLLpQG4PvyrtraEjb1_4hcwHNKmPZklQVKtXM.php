<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* modules/contrib/opigno_dashboard/templates/opigno-dashboard.html.twig */
class __TwigTemplate_51ad4e2443eaa2cb7d1c507b8aabc816 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<base href=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($context["base_path"] ?? null) . ($context["base_href"] ?? null)), "html", null, true);
        yield "\">

<script type=\"text/javascript\">
  window.appConfig = {
    columns: 3,
    positions: [[], [], [], []],
    apiBaseUrl: '";
        // line 7
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["base_path"] ?? null), "html", null, true);
        yield "',
    apiRouteName: '";
        // line 8
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["route_name"] ?? null), "html", null, true);
        yield "',
    getPositioningUrl: '";
        // line 9
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["get_positioning_url"] ?? null), "html", null, true);
        yield "',
    getDefaultPositioningUrl: '";
        // line 10
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["get_default_positioning_url"] ?? null), "html", null, true);
        yield "',
    setPositioningUrl: '";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["set_positioning_url"] ?? null), "html", null, true);
        yield "',
    getBlocksContentUrl: '";
        // line 12
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["blocks_content_url"] ?? null), "html", null, true);
        yield "',
    defaultConfig: '";
        // line 13
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(($context["default_config"] ?? null));
        yield "',
    defaultColumns: '";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(($context["default_columns"] ?? null));
        yield "',
    loading: true,
    locales: {
      title: '";
        // line 17
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Home"));
        yield "',
      manageYourDashboard: '";
        // line 18
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Manage your dashboard"));
        yield "',
      remove: '";
        // line 19
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("remove"));
        yield "',
      close: '";
        // line 20
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("close"));
        yield "',
      saveBtn: '";
        // line 21
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Save"));
        yield "',
      layout: '";
        // line 22
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Layout"));
        yield "',
      oneColumn: '";
        // line 23
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("1 column"));
        yield "',
      twoColumns: '";
        // line 24
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("2 columns"));
        yield "',
      asymColumns: '";
        // line 25
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("1/3-2/3 columns"));
        yield "',
      threeColumns: '";
        // line 26
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("3 columns"));
        yield "',
      threeAsymColumns: '";
        // line 27
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("3/12-5/12-4/12 columns"));
        yield "',
      addBlocks: '";
        // line 28
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Add blocks by dragging them below into the canvas"));
        yield "',
      restoreYourDashboard: '";
        // line 29
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Restore your dashboard to default:"));
        yield "',
      restoreToDefault: '";
        // line 30
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Restore to default"));
        yield "'
    }
  };
</script>

";
        // line 36
        yield "
<app-root class=\"d-block dashboard\">";
        // line 37
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Loading dashboard..."));
        yield "</app-root>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["base_path", "base_href", "route_name", "get_positioning_url", "get_default_positioning_url", "set_positioning_url", "blocks_content_url", "default_config", "default_columns"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/opigno_dashboard/templates/opigno-dashboard.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  151 => 37,  148 => 36,  140 => 30,  136 => 29,  132 => 28,  128 => 27,  124 => 26,  120 => 25,  116 => 24,  112 => 23,  108 => 22,  104 => 21,  100 => 20,  96 => 19,  92 => 18,  88 => 17,  82 => 14,  78 => 13,  74 => 12,  70 => 11,  66 => 10,  62 => 9,  58 => 8,  54 => 7,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/opigno_dashboard/templates/opigno-dashboard.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/opigno_dashboard/templates/opigno-dashboard.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 1, "raw" => 13, "t" => 17);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 'raw', 't'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
