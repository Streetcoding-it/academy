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

/* modules/contrib/opigno_notification/templates/opigno-notifications-header-dropdown.html.twig */
class __TwigTemplate_7f0c196c00cd44d06fa215eaeb21900b extends Template
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
        // line 11
        yield "
<div class=\"notifications-block\">
  ";
        // line 13
        if ((($context["notifications_count"] ?? null) != 0)) {
            // line 14
            yield "    <a class=\"all-read use-ajax\" href=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("opigno_notification.mark_read_all"));
            yield "\">
      ";
            // line 15
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("mark all as read"));
            yield "
    </a>
  ";
        }
        // line 18
        yield "
  ";
        // line 19
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["notifications"] ?? null))) {
            // line 20
            yield "    <ul class=\"notification-list\">
      ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["notifications"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["notification"]) {
                // line 22
                yield "        <li class=\"notification-item\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["notification"], "html", null, true);
                yield "</li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['notification'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            yield "    </ul>
  ";
        }
        // line 26
        yield "
  <div class=\"view-notifications\">
    <a class=\"btn btn-rounded\" href=\"";
        // line 28
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("view.opigno_notifications.page_all"));
        yield "\">
      ";
        // line 29
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("view all notifications"));
        yield "
    </a>
  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["notifications_count", "notifications"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/opigno_notification/templates/opigno-notifications-header-dropdown.html.twig";
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
        return array (  94 => 29,  90 => 28,  86 => 26,  82 => 24,  73 => 22,  69 => 21,  66 => 20,  64 => 19,  61 => 18,  55 => 15,  50 => 14,  48 => 13,  44 => 11,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/opigno_notification/templates/opigno-notifications-header-dropdown.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/opigno_notification/templates/opigno-notifications-header-dropdown.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 13, "for" => 21);
        static $filters = array("t" => 15, "escape" => 22);
        static $functions = array("path" => 14);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['t', 'escape'],
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
