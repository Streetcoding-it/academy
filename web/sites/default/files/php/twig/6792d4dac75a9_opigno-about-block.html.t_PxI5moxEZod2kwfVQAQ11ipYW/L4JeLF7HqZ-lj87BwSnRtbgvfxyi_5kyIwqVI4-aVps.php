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

/* modules/contrib/opigno_dashboard/templates/opigno-about-block.html.twig */
class __TwigTemplate_0d97c53aed6c1bcbb9e7c1790c2e3ae0 extends Template
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
        yield "
<div id=\"aboutModal\" class=\"modal modal-permanent fade\" tabindex=\"-1\" role=\"dialog\" aria-label=\"";
        // line 13
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("About Opigno"));
        yield "\">
  <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h2 class=\"modal-title\">";
        // line 17
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("About"));
        yield "</h2>
        <a class=\"close close-x\" href=\"#\" type=\"button\" data-dismiss=\"modal\" aria-label=\"";
        // line 18
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Close"));
        yield "\">
          <i class=\"fi fi-rr-cross-small\"></i>
        </a>
      </div>

      <div class=\"modal-body\">
        ";
        // line 24
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["logo"] ?? null))) {
            // line 25
            yield "          <img class=\"opigno-logo\" src=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["logo"] ?? null), "html", null, true);
            yield "\" alt=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Logo"));
            yield "\">
        ";
        }
        // line 27
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["texts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["text"]) {
            // line 28
            yield "          <p>";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["text"], "html", null, true);
            yield "</p>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['text'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        yield "        ";
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["version"] ?? null))) {
            // line 31
            yield "          <p>";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ((t("Version") . ": ") . ($context["version"] ?? null)), "html", null, true);
            yield "</p>
        ";
        }
        // line 33
        yield "      </div>
    </div>
  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["logo", "texts", "version"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/opigno_dashboard/templates/opigno-about-block.html.twig";
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
        return array (  100 => 33,  94 => 31,  91 => 30,  82 => 28,  77 => 27,  69 => 25,  67 => 24,  58 => 18,  54 => 17,  47 => 13,  44 => 12,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/opigno_dashboard/templates/opigno-about-block.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/opigno_dashboard/templates/opigno-about-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 24, "for" => 27);
        static $filters = array("t" => 13, "escape" => 25);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['t', 'escape'],
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
