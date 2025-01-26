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

/* modules/contrib/opigno_social/templates/opigno-user-connections-block.html.twig */
class __TwigTemplate_551c3a917ba8995c3bafe3ec54554d30 extends Template
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
";
        // line 13
        if (($context["with_wrapper"] ?? null)) {
            // line 14
            yield "  <div id=\"opigno-connections-communities-block\" class=\"opigno-connections-communities-block content-box\">
";
        }
        // line 16
        yield "
  <h2 class=\"content-box__title\">";
        // line 17
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Connections"));
        yield "</h2>
  ";
        // line 18
        if ((($context["connections"] ?? null) == 0)) {
            // line 19
            yield "    <div class=\"view-empty\">
      ";
            // line 20
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("You have no connection yet"));
            yield "
      ";
            // line 21
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["connections_link"] ?? null), "html", null, true);
            yield "
    </div>
  ";
        } else {
            // line 24
            yield "    <p class=\"connections-number\">
      ";
            // line 25
            yield \Drupal::translation()->formatPlural(abs(            // line 27
($context["connections"] ?? null)), "You have <strong>1</strong> connection", "You have <strong>@connections</strong> connections", array("@connections" =>             // line 28
($context["connections"] ?? null), ));
            // line 30
            yield "    </p>
    ";
            // line 31
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["connections_link"] ?? null), "html", null, true);
            yield "
  ";
        }
        // line 33
        yield "
";
        // line 34
        if (($context["with_wrapper"] ?? null)) {
            // line 35
            yield "  </div>
";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["with_wrapper", "connections", "connections_link"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/opigno_social/templates/opigno-user-connections-block.html.twig";
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
        return array (  95 => 35,  93 => 34,  90 => 33,  85 => 31,  82 => 30,  80 => 28,  79 => 27,  78 => 25,  75 => 24,  69 => 21,  65 => 20,  62 => 19,  60 => 18,  56 => 17,  53 => 16,  49 => 14,  47 => 13,  44 => 12,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/opigno_social/templates/opigno-user-connections-block.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/opigno_social/templates/opigno-user-connections-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 13, "trans" => 25);
        static $filters = array("t" => 17, "escape" => 21);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
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
