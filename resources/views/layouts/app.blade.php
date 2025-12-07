

<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <?php if ( get_field('head', 'option') ) : ?>
    <?php echo get_field('head', 'option'); ?>
    <?php endif; ?>
  </head>

  <body @php(body_class())>
    @php(wp_body_open())
    {{-- <div id="page-loader"
        style="
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #fff;
      z-index: 9999;
      transition: opacity 0.5s ease-in-out;

    ">
    </div> --}}
    <div id="app">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content', 'sage') }}
      </a>

      @include('sections.header', [
        'header_class' => $__env->yieldContent('header_class') ?: (is_front_page() ? 'bg-purple900' : (is_404() ? 'bg-color-2100' : 'bg-color-2'))
      ])

      <main id="main" class=" main">
        @yield('content')
      </main>

      @hasSection('sidebar')
        <aside class="sidebar">
          @yield('sidebar')
        </aside>
      @endif

      @include('sections.footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
    <?php if ( get_field('body', 'option') ) : ?>
    <?php echo get_field('body', 'option'); ?>
    <?php endif; ?>
  </body>
</html>