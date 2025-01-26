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

/* modules/contrib/opigno_dashboard/templates/opigno-dashboard-user-statistics-block.html.twig */
class __TwigTemplate_1a5adcc5864d02911dae00420ae5bdc9 extends Template
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
        // line 14
        yield "
<div class=\"content-box profile-info\">
  <div class=\"edit-link\">
    <a href=\"";
        // line 17
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("entity.user.edit_form", ["user" => ($context["uid"] ?? null)]), "html", null, true);
        yield "\">
      <i class=\"fi fi-rr-edit\"></i>
    </a>
  </div>

  <div class=\"profile-info__body\">
    <div class=\"profile-info__pic\">";
        // line 23
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["user_picture"] ?? null), "html", null, true);
        yield "</div>
    <a href=\"";
        // line 24
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("entity.user.canonical", ["user" => ($context["uid"] ?? null)]), "html", null, true);
        yield "\">
      <h2 class=\"profile-info__name\">";
        // line 25
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["user_name"] ?? null)) > 50)) ? ((Twig\Extension\CoreExtension::slice($this->env->getCharset(), ($context["user_name"] ?? null), 0, 50) . "...")) : (($context["user_name"] ?? null))), "html", null, true);
        yield "</h2>
    </a>
    <div class=\"profile-info__type\">";
        // line 27
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["role"] ?? null), "html", null, true);
        yield "</div>
  </div>

  ";
        // line 30
        if (($context["stats"] ?? null)) {
            // line 31
            yield "    <div class=\"profile-info__statistics\">
      <div class=\"filter\">
        <div class=\"filter__label\">";
            // line 33
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Trends"));
            yield "</div>
        <select name=\"filterRange\" id=\"filterRange\" class=\"form-select selectpicker\">
          <option value=\"7\">";
            // line 35
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Last 7 days"));
            yield "</option>
          <option value=\"30\">";
            // line 36
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Last 30 days"));
            yield "</option>
        </select>
      </div>
      ";
            // line 39
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["stats"] ?? null), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 42
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["uid", "user_picture", "user_name", "role", "stats"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/opigno_dashboard/templates/opigno-dashboard-user-statistics-block.html.twig";
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
        return array (  104 => 42,  98 => 39,  92 => 36,  88 => 35,  83 => 33,  79 => 31,  77 => 30,  71 => 27,  66 => 25,  62 => 24,  58 => 23,  49 => 17,  44 => 14,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/opigno_dashboard/templates/opigno-dashboard-user-statistics-block.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/opigno_dashboard/templates/opigno-dashboard-user-statistics-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 30);
        static $filters = array("escape" => 17, "length" => 25, "slice" => 25, "t" => 33);
        static $functions = array("path" => 17);

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'length', 'slice', 't'],
                ['path'],
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
