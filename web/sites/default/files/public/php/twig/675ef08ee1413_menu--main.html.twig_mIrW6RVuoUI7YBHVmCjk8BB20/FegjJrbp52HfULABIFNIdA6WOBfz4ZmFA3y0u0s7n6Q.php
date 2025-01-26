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

/* themes/contrib/aristotle/templates/menu/menu--main.html.twig */
class __TwigTemplate_7ab4d8dd09e595eff478cf3d13cfec56 extends Template
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
        // line 23
        $macros["menus"] = $this->macros["menus"] = $this;
        // line 24
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::callMacro($macros["menus"], "macro_menu_links", [($context["items"] ?? null), ($context["attributes"] ?? null), 0, ($context["management_menu"] ?? null), ($context["mobile_extra_links"] ?? null)], 24, $context, $this->getSourceContext()));
        yield "

";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["_self", "items", "attributes", "management_menu", "mobile_extra_links", "menu_level"]);        yield from [];
    }

    // line 26
    public function macro_menu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, $__management_menu__ = null, $__mobile_extra_links__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = [
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "management_menu" => $__management_menu__,
            "mobile_extra_links" => $__mobile_extra_links__,
            "varargs" => $__varargs__,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 27
            yield "  ";
            $macros["menus"] = $this;
            // line 28
            yield "  ";
            if (($context["items"] ?? null)) {
                // line 29
                yield "    ";
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 30
                    yield "      <ul ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["main-menu"], "method", false, false, true, 30), "html", null, true);
                    yield ">
    ";
                } else {
                    // line 32
                    yield "      <ul>
    ";
                }
                // line 34
                yield "    ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 35
                    yield "      <li ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "attributes", [], "any", false, false, true, 35), "addClass", ["main-menu__item"], "method", false, false, true, 35), "html", null, true);
                    yield ">
        ";
                    // line 36
                    $context["link_html"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                        // line 37
                        yield "          <span>";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 37), "html", null, true);
                        yield "</span>
        ";
                        yield from [];
                    })())) ? '' : new Markup($tmp, $this->env->getCharset());
                    // line 39
                    yield "
        ";
                    // line 40
                    $context["item_class"] = Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "original_link", [], "any", false, false, true, 40), "pluginId", [], "any", false, false, true, 40), ["opigno_lms." => ""]);
                    // line 41
                    yield "        ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink(($context["link_html"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 41), ["class" => ["main-menu__link", ($context["item_class"] ?? null)], "title" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 41)]), "html", null, true);
                    yield "

        ";
                    // line 43
                    if (CoreExtension::getAttribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 43)) {
                        // line 44
                        yield "          ";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::callMacro($macros["menus"], "macro_menu_links", [CoreExtension::getAttribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 44), ($context["attributes"] ?? null), (($context["menu_level"] ?? null) + 1)], 44, $context, $this->getSourceContext()));
                        yield "
        ";
                    }
                    // line 46
                    yield "      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 48
                yield "
    ";
                // line 50
                yield "    ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["mobile_extra_links"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["mobile_link"]) {
                    // line 51
                    yield "      <li class=\"main-menu__item mobile-only\">
        ";
                    // line 52
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["mobile_link"], "html", null, true);
                    yield "
      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['mobile_link'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 55
                yield "
    ";
                // line 57
                yield "    ";
                if (($context["management_menu"] ?? null)) {
                    // line 58
                    yield "    <li class=\"main-menu__item management\">
      <div class=\"dropdown\">
        <a href=\"javascript:void();\" id=\"dropdownManagement\" class=\"main-menu__link d-flex align-items-center\" data-toggle=\"dropdown\">";
                    // line 60
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Management"));
                    yield "</a>
        <div class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownManagement\">
          <div class=\"container d-flex\">
            <div class=\"info\">
              <h2>";
                    // line 64
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Management"));
                    yield "</h2>
            </div>
            <div class=\"menu-wrapper\">
              ";
                    // line 67
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["management_menu"] ?? null), "html", null, true);
                    yield "
            </div>
          </div>
        </div>
      </div>
    </li>
    ";
                }
                // line 74
                yield "    </ul>
  ";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/aristotle/templates/menu/menu--main.html.twig";
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
        return array (  188 => 74,  178 => 67,  172 => 64,  165 => 60,  161 => 58,  158 => 57,  155 => 55,  146 => 52,  143 => 51,  138 => 50,  135 => 48,  128 => 46,  122 => 44,  120 => 43,  114 => 41,  112 => 40,  109 => 39,  102 => 37,  100 => 36,  95 => 35,  90 => 34,  86 => 32,  80 => 30,  77 => 29,  74 => 28,  71 => 27,  55 => 26,  46 => 24,  44 => 23,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/aristotle/templates/menu/menu--main.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/themes/contrib/aristotle/templates/menu/menu--main.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("import" => 23, "macro" => 26, "if" => 28, "for" => 34, "set" => 36);
        static $filters = array("escape" => 30, "replace" => 40, "t" => 60);
        static $functions = array("link" => 41);

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'set'],
                ['escape', 'replace', 't'],
                ['link'],
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
