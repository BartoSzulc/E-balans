@php
    
use App\Setup\PostFilterSetup;

$categori = PostFilterSetup::get_categories_for_filter();

$all_category = new stdClass();
$all_category->slug = 'all';
$all_category->name = 'Wszystkie';
array_unshift($categori, $all_category);
@endphp

<section class="relative z-10 pb-32 overflow-hidden text-black page-header lg:pb-60 lg:pt-110 pt-44">
  <div class="absolute inset-0 bottom-0 z-0 bg-color-2"></div>
  <div class="absolute right-0 z-0 top-24 lg:top-72 max-lg:translate-x-1/2">
    <img src="@asset('resources/images/w-symbol-hero_2.svg')" class="h-213 lg:h-543" alt=""> 
  </div>
  <div class="container relative z-10">
      <div class="grid grid-cols-12 gap-24">
          <div class="lg:col-start-2 lg:col-span-8 col-span-full">
              <div class="mb-48 breadcrumbs">
                <div class="flex items-center gap-12 text-sm text-color-1">
                  <div class="item">
                    <a href="{{ home_url('/') }}" class="text-sm transition-all duration-300 ease-in-out   hover:text-color-2">Strona główna</a>
                  </div>
                  <svg preserveAspectRatio="xMidYMax meet" class="size-12" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.75 4L7.25 6.5L4.75 9" stroke="#747474" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <div class="item">
                    <p>Wiedza</p>
                  </div>
                </div>
              </div>
              <div class="text-h1" data-aos="fade-up" data-aos-delay="100">
                  <h1>@title</h1>
              </div>
              <div class="flex flex-wrap gap-12 mt-24 lg:mt-40" data-aos="fade-up" data-aos-delay="200">
                @php
                    $categori = get_the_category();
                @endphp
                
                @foreach($categori as $category)
                <span class="px-12 py-6 text-sm text-color-1 bg-color-2 rounded-8">
                    {{ esc_html($category->name) }}
                </span>
                @endforeach
            </div>
          </div>
      </div>
  </div>
</section>
<section class="relative z-10 lg:pt-24 lg:pb-144 pb-72 conclusion bg-color-2100">
  <div class="container wysiwyg">
      <div class="grid grid-cols-12 gap-24">
          <div class="relative col-span-full lg:col-start-2 lg:col-span-10 e-content">
            <div class="flex gap-40 mt-24 lg:mt-40 max-lg:flex-wrap">
              @php
                  $main_toc_items = get_field('main_toc_items') ?? [];
                  @endphp
                   
              @if(!empty($main_toc_items))
              <div class="max-lg:hidden w-336 ">
                <div class="sticky px-32 py-40 text-sm top-150 bg-color-2 text-color-1 rounded-12" data-aos="fade-up" data-aos-delay="100">

                  <div class="table-of-contents text-color-1">
                    <ol class="space-y-16 toc-list">
                      @foreach($main_toc_items as $index => $item)
                        <li class="toc-main-item" data-target="{{ $item['item_id'] }}">
                          <a href="#{{ $item['item_id'] }}" class="toc-link">{{ $item['title'] }}</a>
                          
                          @if(!empty($item['sub_items']))
                            <ol class="pl-24 mt-12 space-y-12">
                              @foreach($item['sub_items'] as $subIndex => $subItem)
                                <li class="toc-sub-item" data-target="{{ $subItem['sub_item_id'] }}">
                                  <a href="#{{ $subItem['sub_item_id'] }}" class="toc-link">{!! $subItem['sub_item_title'] !!}</a>
                                </li>
                              @endforeach
                            </ol>
                          @endif
                        </li>
                      @endforeach
                    </ol>
                  </div>
              
                </div>
              </div>
              @endif
              <div class="@if(empty($main_toc_items)) w-full @else w-1020 @endif">
                <div class="mb-48 lg:mb-64" data-aos="fade-up" data-aos-delay="100">
                  <div class="flex items-center justify-between gap-20 p-16 max-lg:flex-wrap lg:p-40 bg-color-2">
                    <div class="flex items-center gap-20 lg:gap-24">
                      
                      <?php 
                      $author_id = get_the_author_meta('ID');
                      $profile_image = get_field('zdjecie_profilowe', 'user_' . $author_id);
                      if ($profile_image): ?>
                        <img src="<?php echo esc_url($profile_image['url']); ?>" class="object-cover object-center shrink-0 grow-0 size-64 lg:size-80 rounded-8" alt="<?php echo esc_attr($profile_image['alt']); ?>">
                      <?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/resources/images/blog/maria.png" class="object-cover object-center shrink-0 grow-0 size-64 lg:size-80 rounded-8" alt="Default profile image">
                      <?php endif; ?>
                      
                      <div class="space-y-2 text-color-1">
                        <?php 
                        $stanowisko = get_field('stanowisko', 'user_' . $author_id);
                        if ($stanowisko): ?>
                        <div class=" ">
                          <p><?php echo esc_html($stanowisko); ?></p>
                        </div>
                        <?php endif; ?>
                        <p><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></p>
                        
                        
                      </div>
                    </div>
                    <div class="flex flex-col gap-2 lg:text-right">
                      <div class="item">
                        <p><span class=" ">Data publikacji:</span> <?php echo get_the_date('d.m.Y'); ?></p>
                        <p><span class=" ">Czas czytania:</span> <?php echo get_field('reading_time'); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="space-y-48 groups lg:space-y-64">
                  @content
                  
                </div>
                <div class="p-24 mt-40 bg-white lg:mt-64 lg:py-24 lg:px-40 share rounded-12">
                  <div class="flex flex-wrap items-center gap-24 lg:justify-between max-lg">
                    <div class="text-caption tracking-[0.05em] uppercase" data-aos="fade-up" data-aos-delay="100">
                     <p> Udostępnij publikację:</p>
                    </div>
                    <div class="flex gap-16 socials ">
                      <div class="p-8 transition-all duration-500 cursor-pointer rounded-4 social bg-color-2400 hover:bg-purple400" title="Facebook" onclick="shareContent('facebook')">
                        <svg preserveAspectRatio="xMidYMax meet" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M14 3.5C8.225 3.5 3.5 8.24874 3.5 14.0528C3.5 19.2606 7.3535 23.5872 12.32 24.5V17.0075H9.695V14.0528H12.32V11.7312C12.32 9.09297 14 7.61558 16.415 7.61558C17.15 7.61558 17.99 7.72111 18.725 7.82663V10.5176H17.36C16.1 10.5176 15.785 11.1508 15.785 11.995V14.0528H18.5675L18.095 17.0075H15.785V24.4894C20.7462 23.5714 24.5 19.2606 24.5 14.0528C24.5 8.24874 19.775 3.5 14 3.5Z" fill="#393939"/>
                          </svg>
                       
                          
                      </div>
                      <div class="p-8 transition-all duration-500 cursor-pointer rounded-4 social bg-color-2400 hover:bg-purple400" title="LinkedIn" onclick="shareContent('linkedin')">
                        <svg preserveAspectRatio="xMidYMax meet" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M22.1667 3.5H5.83333C4.54417 3.5 3.5 4.54417 3.5 5.83333V22.1667C3.5 23.4558 4.54417 24.5 5.83333 24.5H22.1667C23.4558 24.5 24.5 23.4558 24.5 22.1667V5.83333C24.5 4.54417 23.4558 3.5 22.1667 3.5ZM9.84958 21.5833H6.71708V11.4712H9.84958V21.5833ZM8.26875 10.1471C7.245 10.1471 6.41667 9.31292 6.41667 8.28042C6.41667 7.24792 7.245 6.41375 8.26875 6.41375C9.2925 6.41375 10.1208 7.24792 10.1208 8.28042C10.1208 9.31292 9.2925 10.1471 8.26875 10.1471ZM21.5833 21.5833H18.4683V16.275C18.4683 14.8196 17.9142 14.0058 16.765 14.0058C15.5108 14.0058 14.8575 14.8517 14.8575 16.275V21.5833H11.8533V11.4712H14.8575V12.8333C14.8575 12.8333 15.7617 11.1621 17.9054 11.1621C20.0492 11.1621 21.5862 12.4717 21.5862 15.1812V21.5833H21.5833Z" fill="#393939"/>
                        </svg>
                       
                          
                      </div>
                      <div class="p-8 transition-all duration-500 cursor-pointer social rounded-4 bg-color-2400 hover:bg-purple400" title="X (Twitter)" onclick="shareContent('twitter')">
                        <svg reserveAspectRatio="xMidYMax meet"  viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M17.002 22.7485L12.7762 16.4566L7.4861 22.7485H5.24805L11.7833 14.9778L5.24805 5.24854H10.9941L14.9768 11.1787L19.967 5.24854H22.2051L15.9731 12.6594L22.748 22.7485H17.002ZM19.4943 20.9747H17.9876L8.45261 7.0224H9.95957L13.7784 12.609L14.4388 13.5784L19.4943 20.9747Z" fill="#393939"/>
                        </svg>
                         
                          
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>
</section>
@include('partials.global.cta-w-image', ['class' => 'bg-color-2 text-color-2'])
<section class="relative z-10 read-also py-72 lg:py-104 bg-color-2">
  <div class="container relative z-10">
    <div class="mb-40 text-h2 lg:mb-80 text-color-1" data-aos="fade-up" data-aos-delay="100">
      <h2>Przeczytaj również</h2>
    </div>
    <div class="grid grid-cols-1 gap-24 md:grid-cols-2 lg:grid-cols-3">
      @php
        // Get current post ID
        $current_post_id = get_the_ID();
        
        // Get categories of current post
        $categories = get_the_category($current_post_id);
        $category_ids = [];
        
        // Extract category IDs
        if (!empty($categories)) {
          foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
          }
        }
        
        // Query arguments
        $args = array(
          'category__in'      => $category_ids,
          'post__not_in'      => array($current_post_id),
          'posts_per_page'    => 3,
          'orderby'           => 'date',
          'order'             => 'DESC'
        );
        
        // The Query
        $related_posts = new WP_Query($args);
      @endphp
      
      @if($related_posts->have_posts())
        @php $delay = 100; @endphp
        @while($related_posts->have_posts())
          @php 
            $related_posts->the_post();
            $delay += 100;
          @endphp
          <div data-aos="fade-up" data-aos-delay="{{ $delay }}">
            @include('partials.post-card')
          </div>
        @endwhile
        @php wp_reset_postdata(); @endphp
      @else
        <div class="text-center col-span-full py-30">
          <p>Brak powiązanych artykułów.</p>
        </div>
      @endif
    </div>
  </div>
</section>

