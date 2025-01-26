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

/* themes/contrib/aristotle/templates/views/views-view.html.twig */
class __TwigTemplate_17e7e696fee6b24bee719374e77534eb extends Template
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
            'title' => [$this, 'block_title'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 35
        yield "
";
        // line 37
        $context["classes"] = ["view", ("view-" . \Drupal\Component\Utility\Html::getClass(        // line 39
($context["id"] ?? null))), ("view-id-" .         // line 40
($context["id"] ?? null)), ("view-display-id-" .         // line 41
($context["display_id"] ?? null)), ((        // line 42
($context["dom_id"] ?? null)) ? (("js-view-dom-id-" . ($context["dom_id"] ?? null))) : (""))];
        // line 45
        yield "<div ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 45), "html", null, true);
        yield ">
  ";
        // line 46
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_prefix"] ?? null), "html", null, true);
        yield "
  ";
        // line 47
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        // line 52
        yield "  ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_suffix"] ?? null), "html", null, true);
        yield "

  ";
        // line 54
        if (($context["header"] ?? null)) {
            // line 55
            yield "    <div class=\"content-box__info\">
      ";
            // line 56
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["header"] ?? null), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 59
        yield "
  ";
        // line 60
        if (($context["exposed"] ?? null)) {
            // line 61
            yield "    <div class=\"view-filters form-group\">
      ";
            // line 62
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["exposed"] ?? null), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 65
        yield "
  ";
        // line 66
        if (($context["attachment_before"] ?? null)) {
            // line 67
            yield "    <div class=\"attachment attachment-before\">
      ";
            // line 68
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["attachment_before"] ?? null), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 71
        yield "
  ";
        // line 72
        if (($context["rows"] ?? null)) {
            // line 73
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["rows"] ?? null), "html", null, true);
            yield "
    ";
            // line 74
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["more"] ?? null), "html", null, true);
            yield "

  ";
        } elseif (        // line 76
($context["empty"] ?? null)) {
            // line 77
            yield "    <div class=\"view-empty\">
      ";
            // line 78
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["empty"] ?? null), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 81
        yield "
  ";
        // line 82
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["pager"] ?? null), "html", null, true);
        yield "

  ";
        // line 84
        if (($context["attachment_after"] ?? null)) {
            // line 85
            yield "    <div class=\"attachment attachment-after\">
      ";
            // line 86
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["attachment_after"] ?? null), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 89
        yield "
  ";
        // line 90
        if (($context["footer"] ?? null)) {
            // line 91
            yield "    <div class=\"view-footer\">
      ";
            // line 92
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["footer"] ?? null), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 95
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["id", "display_id", "dom_id", "attributes", "title_prefix", "title_suffix", "header", "exposed", "attachment_before", "rows", "more", "empty", "pager", "attachment_after", "footer", "view"]);        yield from [];
    }

    // line 47
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 48
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["view"] ?? null), "title", [], "any", false, false, true, 48)) {
            // line 49
            yield "      <h2 class=\"content-box__title\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["view"] ?? null), "title", [], "any", false, false, true, 49));
            yield "</h2>
    ";
        }
        // line 51
        yield "  ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/aristotle/templates/views/views-view.html.twig";
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
        return array (  192 => 51,  186 => 49,  183 => 48,  176 => 47,  169 => 95,  163 => 92,  160 => 91,  158 => 90,  155 => 89,  149 => 86,  146 => 85,  144 => 84,  139 => 82,  136 => 81,  130 => 78,  127 => 77,  125 => 76,  120 => 74,  115 => 73,  113 => 72,  110 => 71,  104 => 68,  101 => 67,  99 => 66,  96 => 65,  90 => 62,  87 => 61,  85 => 60,  82 => 59,  76 => 56,  73 => 55,  71 => 54,  65 => 52,  63 => 47,  59 => 46,  54 => 45,  52 => 42,  51 => 41,  50 => 40,  49 => 39,  48 => 37,  45 => 35,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/aristotle/templates/views/views-view.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/themes/contrib/aristotle/templates/views/views-view.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 37, "block" => 47, "if" => 54);
        static $filters = array("clean_class" => 39, "escape" => 45, "raw" => 49);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'block', 'if'],
                ['clean_class', 'escape', 'raw'],
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
