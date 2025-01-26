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

/* modules/contrib/calendar/templates/calendar-pager.html.twig */
class __TwigTemplate_2a5f04d5436f7650ffd0bb2b27d9496f extends Template
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
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 12) || CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 12)) &&  !($context["exclude"] ?? null))) {
            // line 13
            yield "    <nav class=\"pager\" role=\"navigation\" aria-labelledby=\"pagination-heading\">
        <h4 class=\"visually-hidden\">";
            // line 14
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Pagination"));
            yield "</h4>
        <ul class=\"js-pager__items\">
            ";
            // line 16
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 16)) {
                // line 17
                yield "                <li class=\"pager__item pager__item--previous\">
                    <a href=\"";
                // line 18
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 18), "url", [], "any", false, false, true, 18), "html", null, true);
                yield "\" title=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Go to previous page"));
                yield "\" rel=\"prev\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, false, true, 18), "attributes", [], "any", false, false, true, 18), "href", "title", "rel"), "html", null, true);
                yield ">
                        <span aria-hidden=\"true\">";
                // line 19
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, true, true, 19), "text", [], "any", true, true, true, 19)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "previous", [], "any", false, true, true, 19), "text", [], "any", false, false, true, 19), t("‹‹"))) : (t("‹‹"))), "html", null, true);
                yield "</span>
                        <span>";
                // line 20
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Previous"));
                yield "</span>
                    </a>
                </li>
            ";
            }
            // line 24
            yield "            ";
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "current", [], "any", false, false, true, 24)) {
                // line 25
                yield "                <li class=\"pager__item pager__item--current\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "current", [], "any", false, false, true, 25), "html", null, true);
                yield "</li>
            ";
            }
            // line 27
            yield "            ";
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 27)) {
                // line 28
                yield "                <li class=\"pager__item pager__item--next\">
                    <a href=\"";
                // line 29
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 29), "url", [], "any", false, false, true, 29), "html", null, true);
                yield "\" title=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Go to next page"));
                yield "\" rel=\"next\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, false, true, 29), "attributes", [], "any", false, false, true, 29), "href", "title", "rel"), "html", null, true);
                yield ">
                        <span>";
                // line 30
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Next"));
                yield "</span>
                        <span aria-hidden=\"true\">";
                // line 31
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, true, true, 31), "text", [], "any", true, true, true, 31)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["items"] ?? null), "next", [], "any", false, true, true, 31), "text", [], "any", false, false, true, 31), t("››"))) : (t("››"))), "html", null, true);
                yield "</span>
                    </a>
                </li>
            ";
            }
            // line 35
            yield "        </ul>
    </nav>
";
        }
        // line 38
        yield "
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["items", "exclude"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/calendar/templates/calendar-pager.html.twig";
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
        return array (  117 => 38,  112 => 35,  105 => 31,  101 => 30,  93 => 29,  90 => 28,  87 => 27,  81 => 25,  78 => 24,  71 => 20,  67 => 19,  59 => 18,  56 => 17,  54 => 16,  49 => 14,  46 => 13,  44 => 12,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/calendar/templates/calendar-pager.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/calendar/templates/calendar-pager.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 12);
        static $filters = array("t" => 14, "escape" => 18, "without" => 18, "default" => 19);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['t', 'escape', 'without', 'default'],
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
