<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($rawPathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // default_index
        if ('' === $trimmedPathinfo) {
            if ('GET' !== $canonicalMethod) {
                $allow[] = 'GET';
                goto not_default_index;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($rawPathinfo.'/', 'default_index');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'default_index',);
        }
        not_default_index:

        // default_pruebas
        if ('/pruebas' === $pathinfo) {
            if ('POST' !== $canonicalMethod) {
                $allow[] = 'POST';
                goto not_default_pruebas;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::pruebasAction',  '_route' => 'default_pruebas',);
        }
        not_default_pruebas:

        // default_login
        if ('/login' === $pathinfo) {
            if ('POST' !== $canonicalMethod) {
                $allow[] = 'POST';
                goto not_default_login;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::loginAction',  '_route' => 'default_login',);
        }
        not_default_login:

        // user_new
        if ('/user/new' === $pathinfo) {
            if ('POST' !== $canonicalMethod) {
                $allow[] = 'POST';
                goto not_user_new;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\UserController::newAction',  '_route' => 'user_new',);
        }
        not_user_new:

        // user_edit
        if ('/user/edit' === $pathinfo) {
            if ('POST' !== $canonicalMethod) {
                $allow[] = 'POST';
                goto not_user_edit;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\UserController::editAction',  '_route' => 'user_edit',);
        }
        not_user_edit:

        if (0 === strpos($pathinfo, '/noticia')) {
            // noticia_new
            if ('/noticia/new' === $pathinfo) {
                if ('POST' !== $canonicalMethod) {
                    $allow[] = 'POST';
                    goto not_noticia_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\NoticiaController::newAction',  '_route' => 'noticia_new',);
            }
            not_noticia_new:

            // noticia_edit
            if (0 === strpos($pathinfo, '/noticia/edit') && preg_match('#^/noticia/edit(?:/(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
                if ('POST' !== $canonicalMethod) {
                    $allow[] = 'POST';
                    goto not_noticia_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'noticia_edit')), array (  '_controller' => 'AppBundle\\Controller\\NoticiaController::newAction',  'id' => NULL,));
            }
            not_noticia_edit:

            // noticia_list
            if ('/noticia/list' === $pathinfo) {
                if ('POST' !== $canonicalMethod) {
                    $allow[] = 'POST';
                    goto not_noticia_list;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\NoticiaController::noticiasAction',  '_route' => 'noticia_list',);
            }
            not_noticia_list:

            // noticia_detail
            if (0 === strpos($pathinfo, '/noticia/detail') && preg_match('#^/noticia/detail(?:/(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
                if ('POST' !== $canonicalMethod) {
                    $allow[] = 'POST';
                    goto not_noticia_detail;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'noticia_detail')), array (  '_controller' => 'AppBundle\\Controller\\NoticiaController::noticiasAction',  'id' => NULL,));
            }
            not_noticia_detail:

            // noticia_search
            if (0 === strpos($pathinfo, '/noticia/search') && preg_match('#^/noticia/search(?:/(?P<search>[^/]++))?$#s', $pathinfo, $matches)) {
                if ('POST' !== $canonicalMethod) {
                    $allow[] = 'POST';
                    goto not_noticia_search;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'noticia_search')), array (  '_controller' => 'AppBundle\\Controller\\NoticiaController::searchAction',  'search' => NULL,));
            }
            not_noticia_search:

            // noticia_remove
            if (0 === strpos($pathinfo, '/noticia/remove') && preg_match('#^/noticia/remove(?:/(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
                if ('POST' !== $canonicalMethod) {
                    $allow[] = 'POST';
                    goto not_noticia_remove;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'noticia_remove')), array (  '_controller' => 'AppBundle\\Controller\\NoticiaController::removeAction',  'id' => NULL,));
            }
            not_noticia_remove:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
