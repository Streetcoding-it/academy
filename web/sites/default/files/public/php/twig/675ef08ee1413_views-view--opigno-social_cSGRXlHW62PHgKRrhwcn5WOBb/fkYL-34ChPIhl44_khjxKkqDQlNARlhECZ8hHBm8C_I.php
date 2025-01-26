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

/* themes/contrib/aristotle/templates/views/views-view--opigno-social-posts--block-recent.html.twig */
class __TwigTemplate_6add3f5752b72d96676b81153f23f84c extends Template
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
($context["dom_id"] ?? null)) ? (("js-view-dom-id-" . ($context["dom_id"] ?? null))) : ("")), "content-box"];
        // line 46
        yield "<div ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 46), "html", null, true);
        yield ">
  ";
        // line 47
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_prefix"] ?? null), "html", null, true);
        yield "
  ";
        // line 48
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        // line 53
        yield "  ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title_suffix"] ?? null), "html", null, true);
        yield "

  ";
        // line 55
        if (($context["rows"] ?? null)) {
            // line 56
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["rows"] ?? null), "html", null, true);
            yield "
    <div class=\"view-footer\">
      ";
            // line 58
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["footer"] ?? null), "html", null, true);
            yield "
      <a href=\"";
            // line 59
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("opigno_social.feed_page"));
            yield "\">";
            yield "Open social feed";
            yield "</a>
    </div>

  ";
        } elseif (        // line 62
($context["empty"] ?? null)) {
            // line 63
            yield "    <div class=\"view-empty\">
      ";
            // line 64
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["empty"] ?? null), "html", null, true);
            yield "
      <a class=\"btn btn-rounded\" href=\"";
            // line 65
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("opigno_social.feed_page"));
            yield "\">";
            yield "Write your first post";
            yield "</a>
      <a class=\"btn btn-rounded\" href=\"";
            // line 66
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("opigno_social.manage_connections"));
            yield "\">";
            yield "Find connections";
            yield "</a>
    </div>
  ";
        }
        // line 69
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["id", "display_id", "dom_id", "attributes", "title_prefix", "title_suffix", "rows", "footer", "empty", "view"]);        yield from [];
    }

    // line 48
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 49
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["view"] ?? null), "title", [], "any", false, false, true, 49)) {
            // line 50
            yield "      <h2 class=\"content-box__title\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["view"] ?? null), "title", [], "any", false, false, true, 50));
            yield "</h2>
    ";
        }
        // line 52
        yield "  ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/aristotle/templates/views/views-view--opigno-social-posts--block-recent.html.twig";
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
        return array (  137 => 52,  131 => 50,  128 => 49,  121 => 48,  114 => 69,  106 => 66,  100 => 65,  96 => 64,  93 => 63,  91 => 62,  83 => 59,  79 => 58,  73 => 56,  71 => 55,  65 => 53,  63 => 48,  59 => 47,  54 => 46,  52 => 42,  51 => 41,  50 => 40,  49 => 39,  48 => 37,  45 => 35,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/aristotle/templates/views/views-view--opigno-social-posts--block-recent.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/themes/contrib/aristotle/templates/views/views-view--opigno-social-posts--block-recent.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 37, "block" => 48, "if" => 55);
        static $filters = array("clean_class" => 39, "escape" => 46, "raw" => 50);
        static $functions = array("path" => 59);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'block', 'if'],
                ['clean_class', 'escape', 'raw'],
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
