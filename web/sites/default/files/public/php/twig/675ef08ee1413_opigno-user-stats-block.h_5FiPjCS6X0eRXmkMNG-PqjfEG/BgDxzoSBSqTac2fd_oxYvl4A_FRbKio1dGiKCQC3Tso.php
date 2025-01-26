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

/* modules/contrib/opigno_statistics/templates/opigno-user-stats-block.html.twig */
class __TwigTemplate_d8a3690b40fd3df5ed74fcc5555bef9d extends Template
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
        // line 10
        yield "
<ul class=\"statistics-list opigno-user-statistics\">
  ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["stats"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            yield "    <li class=\"statistics-list__item\">
      <span class=\"title\">";
            // line 14
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 14), "html", null, true);
            yield "</span>
      <div>
        <span class=\"number\">";
            // line 16
            (((Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "amount", [], "any", false, false, true, 16))) == "0")) ? (yield "-") : (yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "amount", [], "any", false, false, true, 16), "html", null, true)));
            yield "</span>

        ";
            // line 18
            if ((Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "progress", [], "any", false, false, true, 18))) == "-")) {
                // line 19
                yield "          ";
                $context["progress_class"] = "progress down";
                // line 20
                yield "        ";
            } elseif ((Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "progress", [], "any", false, false, true, 20))) == "0")) {
                // line 21
                yield "          ";
                $context["progress_class"] = "progress";
                // line 22
                yield "        ";
            } else {
                // line 23
                yield "          ";
                $context["progress_class"] = "progress up";
                // line 24
                yield "        ";
            }
            // line 25
            yield "        <span class=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["progress_class"] ?? null), "html", null, true);
            yield "\">
          ";
            // line 26
            if ((CoreExtension::matches("/^\\d+\$/", CoreExtension::getAttribute($this->env, $this->source, $context["item"], "progress", [], "any", false, false, true, 26)) && (CoreExtension::getAttribute($this->env, $this->source, $context["item"], "progress", [], "any", false, false, true, 26) > 0))) {
                // line 27
                yield "            ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ("+" . CoreExtension::getAttribute($this->env, $this->source, $context["item"], "progress", [], "any", false, false, true, 27)), "html", null, true);
                yield "
          ";
            } elseif ((Twig\Extension\CoreExtension::first($this->env->getCharset(), Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source,             // line 28
$context["item"], "progress", [], "any", false, false, true, 28))) == "0")) {
                // line 29
                yield "            ";
                yield "-";
                yield "
          ";
            } else {
                // line 31
                yield "            ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "progress", [], "any", false, false, true, 31), "html", null, true);
                yield "
          ";
            }
            // line 33
            yield "          <i class=\"fi fi-rr-arrow-right\"></i>
        </span>
      </div>
    </li>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        yield "</ul>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["stats"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/opigno_statistics/templates/opigno-user-stats-block.html.twig";
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
        return array (  121 => 38,  111 => 33,  105 => 31,  99 => 29,  97 => 28,  92 => 27,  90 => 26,  85 => 25,  82 => 24,  79 => 23,  76 => 22,  73 => 21,  70 => 20,  67 => 19,  65 => 18,  60 => 16,  55 => 14,  52 => 13,  48 => 12,  44 => 10,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/opigno_statistics/templates/opigno-user-stats-block.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/opigno_statistics/templates/opigno-user-stats-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 12, "if" => 18, "set" => 19);
        static $filters = array("escape" => 14, "first" => 16, "trim" => 16);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if', 'set'],
                ['escape', 'first', 'trim'],
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
