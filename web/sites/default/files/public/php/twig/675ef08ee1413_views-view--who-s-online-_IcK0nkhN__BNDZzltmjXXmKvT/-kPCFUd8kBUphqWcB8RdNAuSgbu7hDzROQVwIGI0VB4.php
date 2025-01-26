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

/* themes/contrib/aristotle/templates/views/views-view--who-s-online--who-s-online-block.html.twig */
class __TwigTemplate_117fd9b15d66e51bb413e98e6d0a97a3 extends Template
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
        if (($context["rows"] ?? null)) {
            // line 55
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["rows"] ?? null), "html", null, true);
            yield "
    <div class=\"view-footer\">
      ";
            // line 57
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["footer"] ?? null), "html", null, true);
            yield "
      <a href=\"";
            // line 58
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("opigno_dashboard.get_online_users"));
            yield "\" class=\"use-ajax\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("See all connected users"));
            yield "</a>
    </div>

  ";
        } else {
            // line 62
            yield "    <div class=\"view-empty\">
      ";
            // line 63
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["empty"] ?? null), "html", null, true);
            yield "
      <div class=\"empty-user\"></div>
      <div class=\"empty-user\"></div>
    </div>
  ";
        }
        // line 68
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["id", "display_id", "dom_id", "attributes", "title_prefix", "title_suffix", "rows", "footer", "empty", "view"]);        yield from [];
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
        return "themes/contrib/aristotle/templates/views/views-view--who-s-online--who-s-online-block.html.twig";
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
        return array (  126 => 51,  120 => 49,  117 => 48,  110 => 47,  103 => 68,  95 => 63,  92 => 62,  83 => 58,  79 => 57,  73 => 55,  71 => 54,  65 => 52,  63 => 47,  59 => 46,  54 => 45,  52 => 42,  51 => 41,  50 => 40,  49 => 39,  48 => 37,  45 => 35,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/aristotle/templates/views/views-view--who-s-online--who-s-online-block.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/themes/contrib/aristotle/templates/views/views-view--who-s-online--who-s-online-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 37, "block" => 47, "if" => 54);
        static $filters = array("clean_class" => 39, "escape" => 45, "t" => 58, "raw" => 49);
        static $functions = array("path" => 58);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'block', 'if'],
                ['clean_class', 'escape', 't', 'raw'],
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
