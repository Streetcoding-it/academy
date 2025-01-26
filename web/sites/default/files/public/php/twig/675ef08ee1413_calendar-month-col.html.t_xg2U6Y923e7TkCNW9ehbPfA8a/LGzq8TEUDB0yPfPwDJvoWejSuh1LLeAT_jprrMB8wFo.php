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

/* modules/contrib/opigno_calendar/templates/calendar-month-col.html.twig */
class __TwigTemplate_ba24b76d9d0244faeabb036b75859760 extends Template
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
        // line 12
        if ((is_string($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "class", [], "any", false, false, true, 12)) && is_string($__internal_compile_1 = "single-day no-entry") && str_starts_with($__internal_compile_0, $__internal_compile_1))) {
            // line 13
            yield "  <td
    id=\"";
            // line 14
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "id", [], "any", false, false, true, 14) . "_empty"), "html", null, true);
            yield "\"
    date-date=\"";
            // line 15
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "date", [], "any", false, false, true, 15), "html", null, true);
            yield "\"
    data-day-of-month=\"";
            // line 16
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "day_of_month", [], "any", false, false, true, 16), "html", null, true);
            yield "\"
    headers=\"";
            // line 17
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "header_id", [], "any", false, false, true, 17), "html", null, true);
            yield "\"
    class=\"";
            // line 18
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "class", [], "any", false, false, true, 18), "html", null, true);
            yield "\"
    colspan=\"";
            // line 19
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "colspan", [], "any", false, false, true, 19), "html", null, true);
            yield "\"
    rowspan=\"";
            // line 20
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "rowspan", [], "any", false, false, true, 20), "html", null, true);
            yield "\">
    <div class=\"inner\">
      <div class=\"date-box\"><span class=\"date-day\">";
            // line 22
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "date", [], "any", false, false, true, 22), "d"), "html", null, true);
            yield "</span>
        <span class=\"date-month\">";
            // line 23
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "date", [], "any", false, false, true, 23), "F"), [], ["context" => "Long month name"]));
            yield "</span>
        <span class=\"date-year\">";
            // line 24
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "date", [], "any", false, false, true, 24), "Y"), "html", null, true);
            yield "</span>
      </div>
      <h4 class=\"title\">";
            // line 26
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("No Event"));
            yield "</h4>
    </div>
  </td>
";
        } else {
            // line 30
            yield "  <td
    id=\"";
            // line 31
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "id", [], "any", false, false, true, 31), "html", null, true);
            yield "\"
    date-date=\"";
            // line 32
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "date", [], "any", false, false, true, 32), "html", null, true);
            yield "\"
    data-day-of-month=\"";
            // line 33
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "day_of_month", [], "any", false, false, true, 33), "html", null, true);
            yield "\"
    headers=\"";
            // line 34
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "header_id", [], "any", false, false, true, 34), "html", null, true);
            yield "\"
    class=\"";
            // line 35
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "class", [], "any", false, false, true, 35), "html", null, true);
            yield "\"
    colspan=\"";
            // line 36
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "colspan", [], "any", false, false, true, 36), "html", null, true);
            yield "\"
    rowspan=\"";
            // line 37
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "rowspan", [], "any", false, false, true, 37), "html", null, true);
            yield "\">
    <div class=\"inner\">
      ";
            // line 39
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "entry", [], "any", false, false, true, 39), "html", null, true);
            yield "
    </div>
  </td>
";
        }
        // line 43
        yield "
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["item"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/opigno_calendar/templates/calendar-month-col.html.twig";
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
        return array (  137 => 43,  130 => 39,  125 => 37,  121 => 36,  117 => 35,  113 => 34,  109 => 33,  105 => 32,  101 => 31,  98 => 30,  91 => 26,  86 => 24,  82 => 23,  78 => 22,  73 => 20,  69 => 19,  65 => 18,  61 => 17,  57 => 16,  53 => 15,  49 => 14,  46 => 13,  44 => 12,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/opigno_calendar/templates/calendar-month-col.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/opigno_calendar/templates/calendar-month-col.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 12);
        static $filters = array("escape" => 14, "date" => 22, "t" => 23);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'date', 't'],
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
