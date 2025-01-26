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

/* modules/contrib/opigno_dashboard/templates/opigno-site-header.html.twig */
class __TwigTemplate_ba5dfcac15a985493be1e7593d182ebe extends Template
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
            'user_menu' => [$this, 'block_user_menu'],
            'dropdown_menu' => [$this, 'block_dropdown_menu'],
            'profile' => [$this, 'block_profile'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 18
        yield "
<header class=\"page-header\" role=\"banner\">
  <div class=\"container\">
    <div class=\"row align-items-center\">
      ";
        // line 22
        if ( !($context["is_anonymous"] ?? null)) {
            // line 23
            yield "      <div class=\"col-lg-9 col-xxl-8 col-left\">
      ";
        } else {
            // line 25
            yield "      <div class=\"col-lg-12 col-xxl-12 col-left\">
      ";
        }
        // line 27
        yield "        ";
        // line 28
        yield "        ";
        if ( !Twig\Extension\CoreExtension::testEmpty(($context["logo"] ?? null))) {
            // line 29
            yield "          <div class=\"region region-branding\">
            <div class=\"block-system-branding-block\">
              <a class=\"home-link\" href=\"";
            // line 31
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("<front>"));
            yield "\">
                <img class=\"logo\" src=\"";
            // line 32
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["logo"] ?? null), "html", null, true);
            yield "\" alt=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Home"));
            yield "\">
              </a>
            </div>
          </div>
        ";
        }
        // line 37
        yield "
        <div class=\"region-main-menu\">
          <nav>";
        // line 39
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["menu"] ?? null), "html", null, true);
        yield "</nav>
        </div>

        ";
        // line 43
        yield "        <div class=\"mobile-menu-btn\">
          <span></span>
          <span></span>
          <span></span>
        </div>

        ";
        // line 50
        yield "        <div class=\"mobile-header-wrapper\">
          <div class=\"mobile-header\">
            <nav>";
        // line 52
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["menu"] ?? null), "html", null, true);
        yield "</nav>
              ";
        // line 54
        yield "            <div class=\"block-notifications\">
              <div class=\"block-notifications__item block-notifications__item--notifications\">
                <div class=\"dropdown\">
                  <a href=\"";
        // line 57
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("view.opigno_notifications.page_all"));
        yield "\">
                    <i class=\"fi fi-rr-bell\">
                      ";
        // line 59
        $context["classes"] = (((($context["notifications_count"] ?? null) != 0)) ? ("marker") : ("marker hidden"));
        // line 60
        yield "                      <span class=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["classes"] ?? null), "html", null, true);
        yield "\"></span>
                    </i>
                  </a>
                </div>
              </div>

              ";
        // line 66
        yield from $this->unwrap()->yieldBlock('user_menu', $context, $blocks);
        // line 125
        yield "            </div>

            ";
        // line 127
        yield from $this->unwrap()->yieldBlock('profile', $context, $blocks);
        // line 135
        yield "            ";
        yield from         $this->unwrap()->yieldBlock("dropdown_menu", $context, $blocks);
        yield "
          </div>
        </div>
      </div>

      ";
        // line 140
        if ( !($context["is_anonymous"] ?? null)) {
            // line 141
            yield "      <div class=\"col-lg-3 col-xxl-4 col-right\">
        ";
            // line 142
            yield from             $this->unwrap()->yieldBlock("profile", $context, $blocks);
            yield "

        <div class=\"block-notifications\">
          <div class=\"block-notifications__item block-notifications__item--notifications\">
            <div class=\"dropdown\">
              <a class=\"dropdown-toggle\" href=\"#\" data-toggle=\"dropdown\" aria-expanded=\"false\">
                <i class=\"fi fi-rr-bell\">
                  ";
            // line 149
            $context["classes"] = (((($context["notifications_count"] ?? null) != 0)) ? ("marker") : ("marker hidden"));
            // line 150
            yield "                  <span class=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["classes"] ?? null), "html", null, true);
            yield "\"></span>
                </i>
              </a>

              <div class=\"dropdown-menu dropdown-menu-right ";
            // line 154
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["notifications_count"] ?? null) == 0)) ? ("hidden") : ("")));
            yield "\">
                ";
            // line 155
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["notifications"] ?? null), "html", null, true);
            yield "
              </div>
            </div>
          </div>
          ";
            // line 159
            yield from             $this->unwrap()->yieldBlock("user_menu", $context, $blocks);
            yield "
        </div>

      </div>
      ";
        }
        // line 164
        yield "
    </div>
  </div>
</header>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["is_anonymous", "logo", "menu", "notifications_count", "notifications", "messages_count", "dropdown_menu", "loop", "is_user_page", "user_url", "user_name", "user_picture"]);        yield from [];
    }

    // line 66
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_user_menu(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 67
        yield "                ";
        // line 68
        yield "                <div class=\"block-notifications__item block-notifications__item--messages\">
                  <div class=\"dropdown\">
                    <a href=\"";
        // line 70
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("private_message.private_message_page"));
        yield "\">
                      <i class=\"fi fi-rr-envelope\">
                        ";
        // line 72
        $context["classes"] = (((($context["messages_count"] ?? null) != 0)) ? ("marker") : ("marker hidden"));
        // line 73
        yield "                        <span class=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["classes"] ?? null), "html", null, true);
        yield "\"></span>
                      </i>
                    </a>
                  </div>
                </div>

                ";
        // line 80
        yield "                <div class=\"block-notifications__item block-notifications__item--user-menu\">
                  <div class=\"dropdown\">
                    <a class=\"dropdown-toggle\" href=\"#\" data-toggle=\"dropdown\" aria-expanded=\"false\">
                      <i class=\"fi fi-rr-angle-small-down\"></i>
                    </a>
                    <div class=\"dropdown-menu dropdown-menu-right\">
                      <div class=\"user-menu-block\">
                        <div class=\"user-name\">
                          <div class=\"user-firstname\">
                            ";
        // line 89
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["dropdown_menu"] ?? null), "name", [], "any", false, false, true, 89), "html", null, true);
        yield "
                          </div>
                          <div class=\"user-username\">
                            ";
        // line 92
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["dropdown_menu"] ?? null), "username", [], "any", false, false, true, 92), "html", null, true);
        yield "
                          </div>
                          <span>";
        // line 94
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["dropdown_menu"] ?? null), "role", [], "any", false, false, true, 94), "html", null, true);
        yield "</span>
                        </div>

                        ";
        // line 98
        yield "                        ";
        yield from $this->unwrap()->yieldBlock('dropdown_menu', $context, $blocks);
        // line 120
        yield "                      </div>
                    </div>
                  </div>
                </div>
              ";
        yield from [];
    }

    // line 98
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_dropdown_menu(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 99
        yield "                          <ul class=\"user-menu-list\">
                            ";
        // line 100
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["dropdown_menu"] ?? null), "links", [], "any", false, false, true, 100));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["key"] => $context["link"]) {
            // line 101
            yield "                              <li class=\"user-menu-item ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["key"], "html", null, true);
            yield "\">
                                <a href=\"";
            // line 102
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["link"], "path", [], "any", false, false, true, 102), "html", null, true);
            yield "\" class=\"user-menu-item-text\" target=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(((CoreExtension::getAttribute($this->env, $this->source, $context["link"], "external", [], "any", false, false, true, 102)) ? ("_blank") : ("_self")));
            yield "\">
                                  <i class=\"fi ";
            // line 103
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["link"], "icon_class", [], "any", false, false, true, 103), "html", null, true);
            yield "\"></i>
                                  ";
            // line 104
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["link"], "title", [], "any", false, false, true, 104), "html", null, true);
            yield "
                                </a>
                              </li>

                              ";
            // line 109
            yield "                              ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, true, 109) && CoreExtension::getAttribute($this->env, $this->source, ($context["dropdown_menu"] ?? null), "is_admin", [], "any", false, false, true, 109))) {
                // line 110
                yield "                                <li class=\"user-menu-item\">
                                  <a href=\"#\" class=\"user-menu-item-text\" data-toggle=\"modal\" data-target=\"#aboutModal\">
                                    <i class=\"fi fi-rr-info\"></i>
                                    ";
                // line 113
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("About"));
                yield "
                                  </a>
                                </li>
                              ";
            }
            // line 117
            yield "                            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 118
        yield "                          </ul>
                        ";
        yield from [];
    }

    // line 127
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_profile(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 128
        yield "              <div class=\"block-profile\">
                <a class=\"block-profile__link ";
        // line 129
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(((($context["is_user_page"] ?? null)) ? ("active") : ("")));
        yield "\" href=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["user_url"] ?? null), "html", null, true);
        yield "\">
                  <span class=\"profile-name\">";
        // line 130
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["user_name"] ?? null)) > 50)) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (Twig\Extension\CoreExtension::slice($this->env->getCharset(), ($context["user_name"] ?? null), 0, 50) . "..."), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["user_name"] ?? null), "html", null, true)));
        yield "</span>
                  <span class=\"profile-pic\">";
        // line 131
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["user_picture"] ?? null), "html", null, true);
        yield "</span>
                </a>
              </div>
            ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/opigno_dashboard/templates/opigno-site-header.html.twig";
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
        return array (  379 => 131,  375 => 130,  369 => 129,  366 => 128,  359 => 127,  353 => 118,  339 => 117,  332 => 113,  327 => 110,  324 => 109,  317 => 104,  313 => 103,  307 => 102,  302 => 101,  285 => 100,  282 => 99,  275 => 98,  266 => 120,  263 => 98,  257 => 94,  252 => 92,  246 => 89,  235 => 80,  225 => 73,  223 => 72,  218 => 70,  214 => 68,  212 => 67,  205 => 66,  195 => 164,  187 => 159,  180 => 155,  176 => 154,  168 => 150,  166 => 149,  156 => 142,  153 => 141,  151 => 140,  142 => 135,  140 => 127,  136 => 125,  134 => 66,  124 => 60,  122 => 59,  117 => 57,  112 => 54,  108 => 52,  104 => 50,  96 => 43,  90 => 39,  86 => 37,  76 => 32,  72 => 31,  68 => 29,  65 => 28,  63 => 27,  59 => 25,  55 => 23,  53 => 22,  47 => 18,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/opigno_dashboard/templates/opigno-site-header.html.twig", "/web/htdocs/www.streetcoding.it/home/edu/web/modules/contrib/opigno_dashboard/templates/opigno-site-header.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 22, "set" => 59, "block" => 66, "for" => 100);
        static $filters = array("escape" => 32, "t" => 32, "length" => 130, "slice" => 130);
        static $functions = array("path" => 31);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'block', 'for'],
                ['escape', 't', 'length', 'slice'],
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
