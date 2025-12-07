(function() {
    const { registerBlockType } = wp.blocks;
    const { __ } = wp.i18n;
    const { 
      RichText,
      MediaUpload,
      MediaUploadCheck,
      InspectorControls, 
      useBlockProps 
    } = wp.blockEditor;
    const { 
      PanelBody, 
      SelectControl,
      ToggleControl,
      Button,
      TextControl
    } = wp.components;
    const { createElement, Fragment } = wp.element;
  
    // Register the block
    registerBlockType('sage/testimonial', {
      apiVersion: 3,
      title: __('Testimonial', 'sage'),
      description: __('Blok z rekomendacją klienta', 'sage'),
      category: 'sage-blocks',
      icon: 'format-quote',
      supports: {
        align: true,
        html: true,
      },
      attributes: {
        quote: {
          type: 'string',
          default: 'WSK Growth to specjaliści w pozyskiwaniu klientów, którzy skutecznie wspierają rozwój eCommerce, stawiając na partnerską współpracę i strategiczne myślenie biznesowe.',
        },
        position: {
          type: 'string',
          default: 'Marketing Manager w WSK Growth',
        },
        name: {
          type: 'string',
          default: 'Karolina Budzyńska',
        },
        bgColor: {
          type: 'string',
          default: 'primary', // 'primary' or 'purple'
        },
        hasImage: {
          type: 'boolean',
          default: false,
        },
        imageUrl: {
          type: 'string',
          default: '',
        },
        imageId: {
          type: 'number',
        },
        imageAlt: {
          type: 'string',
          default: '',
        },
        showSymbol: {
          type: 'boolean',
          default: true,
        }
      },
      
      edit: function(props) {
        const { attributes, setAttributes } = props;
        const { quote, position, name, bgColor, hasImage, imageUrl, imageId, imageAlt, showSymbol } = attributes;
        
        // Generate classes based on attributes
        const generateClasses = () => {
          let classes = [];
          
          if (hasImage) {
            classes.push('relative flex gap-[24px] p-[24px] overflow-hidden rounded-[12px] max-lg:py-[32px] lg:gap-[32px] max-lg:flex-col testimonial lg:p-[40px]');
          } else {
            classes.push('relative flex flex-col gap-[24px] px-[24px] py-[32px] overflow-hidden rounded-[12px] testimonial lg:p-[40px] lg:gap-[32px]');
          }
          
          if (bgColor === 'primary') {
            classes.push('bg-color-2');
          } else if (bgColor === 'purple') {
            classes.push(' ');
          }
          
          return classes.join(' ');
        };
        
        const blockProps = useBlockProps({
          className: generateClasses(),
        });
        
        // Image selection handler
        const onSelectImage = (media) => {
          setAttributes({
            imageUrl: media.url,
            imageId: media.id,
            imageAlt: media.alt || ''
          });
        };
        
        // Remove image handler
        const removeImage = () => {
          setAttributes({
            imageUrl: '',
            imageId: undefined,
            imageAlt: ''
          });
        };
        
        // Create the background decoration SVG element
        const renderBackgroundSymbol = () => {
          if (!showSymbol) return null;
          
          return createElement(
            'div',
            {
              className: 'absolute -right-[496px] lg:-right-[62px] lg:top-[24px] w-[735px] h-[400px]'
            },
            createElement(
              'svg',
              {
                preserveAspectRatio: 'xMidYMax meet',
                viewBox: '0 0 1440 784',
                fill: 'none',
                xmlns: 'http://www.w3.org/2000/svg',
                className: 'size-full'
              },
              createElement(
                'path',
                {
                  d: 'M260.713 0.299805C296.433 0.29986 329.177 19.8819 346.304 51.3369L347.107 52.8438H347.108L485.166 316.853L485.368 317.24L485.657 316.911L733.886 33.6045C752.473 12.3455 779.305 0.380981 807.269 0.380859H1015.39V317.486L1015.92 316.916L1277.28 31.0146L1277.28 31.0137C1294.97 11.5348 1320.11 0.380859 1346.37 0.380859H1439.7V316.762L1059.89 751.773C1042.12 771.899 1016.58 783.457 989.671 783.457H894.96V315.429L894.434 316.029L514.309 750.233L514.308 750.235C495.72 771.737 469.051 783.7 440.926 783.7H343.62V316.17H166.693L0.49707 0.299805H260.713Z',
                  stroke: '#B5B5B5',
                  strokeWidth: '0.6'
                }
              )
            )
          );
        };
        
        // Available background color options
        const bgColorOptions = [
          { label: __('Szary', 'sage'), value: 'primary' },
          { label: __('Fioletowy', 'sage'), value: 'purple' },
        ];
        
        return createElement(
          Fragment,
          {},
          [
            // Inspector Controls (sidebar)
            createElement(
              InspectorControls,
              { key: 'inspector' },
              createElement(
                PanelBody,
                { 
                  title: __('Ustawienia testimonial', 'sage'),
                  initialOpen: true
                },
                [
                  createElement(SelectControl, {
                    label: __('Kolor tła', 'sage'),
                    value: bgColor,
                    options: bgColorOptions,
                    onChange: (value) => {
                      setAttributes({ bgColor: value });
                    }
                  }),
                  createElement(ToggleControl, {
                    label: __('Pokaż symbol', 'sage'),
                    checked: showSymbol,
                    onChange: (value) => {
                      setAttributes({ showSymbol: value });
                    }
                  }),
                  createElement(ToggleControl, {
                    label: __('Pokaż zdjęcie', 'sage'),
                    checked: hasImage,
                    onChange: (value) => {
                      setAttributes({ hasImage: value });
                    }
                  }),
                  hasImage && createElement(
                    'div',
                    { className: 'components-base-control' },
                    [
                      createElement(
                        'label',
                        { className: 'components-base-control__label' },
                        __('Wybierz zdjęcie', 'sage')
                      ),
                      createElement(
                        'div',
                        { style: { marginTop: '8px' } },
                        createElement(
                          MediaUploadCheck,
                          {},
                          createElement(
                            MediaUpload,
                            {
                              onSelect: onSelectImage,
                              allowedTypes: ['image'],
                              value: imageId,
                              render: ({ open }) => {
                                if (!imageUrl) {
                                  return createElement(
                                    Button,
                                    {
                                      onClick: open,
                                      variant: 'secondary',
                                      isSmall: false
                                    },
                                    __('Wybierz zdjęcie', 'sage')
                                  );
                                }
                                return createElement(
                                  'div',
                                  {},
                                  [
                                    createElement(
                                      'img',
                                      {
                                        src: imageUrl,
                                        alt: imageAlt,
                                        style: { maxWidth: '100%', maxHeight: '150px', marginBottom: '8px' }
                                      }
                                    ),
                                    createElement(
                                      'div',
                                      { className: 'button-container' },
                                      [
                                        createElement(
                                          Button,
                                          {
                                            onClick: open,
                                            variant: 'secondary',
                                            isSmall: true,
                                            style: { marginRight: '8px' }
                                          },
                                          __('Zmień zdjęcie', 'sage')
                                        ),
                                        createElement(
                                          Button,
                                          {
                                            onClick: removeImage,
                                            variant: 'secondary',
                                            isDestructive: true,
                                            isSmall: true
                                          },
                                          __('Usuń zdjęcie', 'sage')
                                        )
                                      ]
                                    )
                                  ]
                                );
                              }
                            }
                          )
                        )
                      ),
                      createElement(
                        TextControl,
                        {
                          label: __('Tekst alternatywny', 'sage'),
                          value: imageAlt,
                          onChange: (value) => {
                            setAttributes({ imageAlt: value });
                          },
                          style: { marginTop: '8px' }
                        }
                      )
                    ]
                  )
                ]
              )
            ),
            
            // Content
            createElement(
              'div',
              blockProps,
              [
                // Quote and footer container
                hasImage ? 
                  // With image layout
                  [
                    createElement(
                      'div',
                      { className: 'flex flex-col h-full gap-[24px]' },
                      [
                        // Quote
                        createElement(
                          RichText,
                          {
                            tagName: 'div',
                            className: '  max-w-[606px] text-color-1',
                            value: quote,
                            onChange: (value) => setAttributes({ quote: value }),
                            placeholder: __('Wpisz rekomendację...', 'sage')
                          }
                        ),
                        // Footer with small image (mobile) and author info
                        createElement(
                          'div',
                          { className: 'flex items-center gap-[20px] mt-auto' },
                          [
                            // Mobile image (hidden on desktop)
                            createElement(
                              'div',
                              { className: 'lg:hidden size-[64px] shrink-0 grow-0' },
                              imageUrl ? 
                                createElement(
                                  'img',
                                  {
                                    src: imageUrl,
                                    alt: imageAlt,
                                    className: 'object-cover object-center size-full rounded-[8px]'
                                  }
                                ) :
                                createElement(
                                  'div',
                                  { className: 'bg-gray-200 size-full rounded-[8px] flex items-center justify-center text-gray-500 text-[10px]' },
                                  __('Brak zdjęcia', 'sage')
                                )
                            ),
                            // Author info
                            createElement(
                              'div',
                              { className: 'space-y-[2px] max-lg:text-sm' },
                              [
                                // Position
                                createElement(
                                  RichText,
                                  {
                                    tagName: 'div',
                                    className: ' ',
                                    value: position,
                                    onChange: (value) => setAttributes({ position: value }),
                                    placeholder: __('Stanowisko...', 'sage')
                                  }
                                ),
                                // Name
                                createElement(
                                  RichText,
                                  {
                                    tagName: 'div',
                                    className: 'text-color-1',
                                    value: name,
                                    onChange: (value) => setAttributes({ name: value }),
                                    placeholder: __('Imię i nazwisko...', 'sage')
                                  }
                                )
                              ]
                            )
                          ]
                        )
                      ]
                    ),
                    // Desktop image
                    createElement(
                      'div',
                      { className: 'shrink-0 grow-0 w-[300px] h-[400px] max-lg:hidden ml-auto relative z-10' },
                      imageUrl ? 
                        createElement(
                          'img',
                          {
                            src: imageUrl,
                            alt: imageAlt,
                            className: 'object-cover object-center rounded-[12px] size-full'
                          }
                        ) :
                        createElement(
                          'div',
                          { className: 'bg-gray-200 size-full rounded-[12px] flex items-center justify-center text-gray-500' },
                          __('Wybierz zdjęcie w panelu bocznym', 'sage')
                        )
                    ),
                    // Background symbol if enabled
                    showSymbol && renderBackgroundSymbol()
                  ] :
                  // Without image layout
                  [
                    // Quote
                    createElement(
                      RichText,
                      {
                        tagName: 'div',
                        className: '  max-w-[696px] text-color-1',
                        value: quote,
                        onChange: (value) => setAttributes({ quote: value }),
                        placeholder: __('Wpisz rekomendację...', 'sage')
                      }
                    ),
                    // Author info
                    createElement(
                      'div',
                      { className: 'space-y-[2px] max-lg:text-sm' },
                      [
                        // Position
                        createElement(
                          RichText,
                          {
                            tagName: 'div',
                            className: ' ',
                            value: position,
                            onChange: (value) => setAttributes({ position: value }),
                            placeholder: __('Stanowisko...', 'sage')
                          }
                        ),
                        // Name
                        createElement(
                          RichText,
                          {
                            tagName: 'div',
                            className: 'text-color-1',
                            value: name,
                            onChange: (value) => setAttributes({ name: value }),
                            placeholder: __('Imię i nazwisko...', 'sage')
                          }
                        )
                      ]
                    ),
                    // Background symbol if enabled
                    showSymbol && renderBackgroundSymbol()
                  ]
              ]
            )
          ]
        );
      },
      
      save: function(props) {
        const { attributes } = props;
        const { quote, position, name, bgColor, hasImage, imageUrl, imageAlt, showSymbol } = attributes;
        
        // Generate classes for saved content - without brackets for frontend
        const generateClasses = () => {
          let classes = [];
          
          if (hasImage) {
            classes.push('relative flex gap-24 p-24 overflow-hidden rounded-12 max-lg:py-32 lg:gap-32 max-lg:flex-col testimonial lg:p-40');
          } else {
            classes.push('relative flex flex-col gap-24 px-24 py-32 overflow-hidden rounded-12 testimonial lg:p-40 lg:gap-32');
          }
          
          if (bgColor === 'primary') {
            classes.push('bg-color-2');
          } else if (bgColor === 'purple') {
            classes.push(' ');
          }
          
          return classes.join(' ');
        };
        
        const blockProps = useBlockProps.save({
          className: generateClasses(),
        });
        
        // Create the background decoration SVG element for frontend
        const renderBackgroundSymbol = () => {
          if (!showSymbol) return null;
          
          return createElement(
            'div',
            {
              className: 'absolute -right-496 lg:-right-62 lg:top-24 w-735 h-400 z-0'
            },
            createElement(
              'svg',
              {
                preserveAspectRatio: 'xMidYMax meet',
                viewBox: '0 0 1440 784',
                fill: 'none',
                xmlns: 'http://www.w3.org/2000/svg',
                className: 'size-full'
              },
              createElement(
                'path',
                {
                  d: 'M260.713 0.299805C296.433 0.29986 329.177 19.8819 346.304 51.3369L347.107 52.8438H347.108L485.166 316.853L485.368 317.24L485.657 316.911L733.886 33.6045C752.473 12.3455 779.305 0.380981 807.269 0.380859H1015.39V317.486L1015.92 316.916L1277.28 31.0146L1277.28 31.0137C1294.97 11.5348 1320.11 0.380859 1346.37 0.380859H1439.7V316.762L1059.89 751.773C1042.12 771.899 1016.58 783.457 989.671 783.457H894.96V315.429L894.434 316.029L514.309 750.233L514.308 750.235C495.72 771.737 469.051 783.7 440.926 783.7H343.62V316.17H166.693L0.49707 0.299805H260.713Z',
                  stroke: '#B5B5B5',
                  strokeWidth: '0.6'
                }
              )
            )
          );
        };
        
        return createElement(
          'div',
          blockProps,
          hasImage ? 
            // With image layout
            [
              createElement(
                'div',
                { className: 'flex flex-col h-full gap-24 grow-0 shrink-0 self-stretch lg:min-h-400' },
                [
                  // Quote
                  createElement(
                    'div',
                    { className: '  max-w-606 text-color-1' },
                    quote
                  ),
                  // Footer with small image (mobile) and author info
                  createElement(
                    'div',
                    { className: 'flex items-center gap-20 mt-auto' },
                    [
                      // Mobile image (hidden on desktop)
                      createElement(
                        'div',
                        { className: 'lg:hidden size-64 shrink-0 grow-0' },
                        imageUrl && createElement(
                          'img',
                          {
                            src: imageUrl,
                            alt: imageAlt,
                            className: 'object-cover object-center size-full rounded-8 relative z-10'
                          }
                        )
                      ),
                      // Author info
                      createElement(
                        'div',
                        { className: 'space-y-2 max-lg:text-sm' },
                        [
                          // Position
                          createElement(
                            'div',
                            { className: ' ' },
                            position
                          ),
                          // Name
                          createElement(
                            'div',
                            { className: 'text-color-1' },
                            name
                          )
                        ]
                      )
                    ]
                  )
                ]
              ),
              // Desktop image
              createElement(
                'div',
                { className: 'shrink-0 grow-0 w-300 h-400 max-lg:hidden' },
                imageUrl && createElement(
                  'img',
                  {
                    src: imageUrl,
                    alt: imageAlt,
                    className: 'object-cover object-center rounded-12 size-full relative z-10'
                  }
                )
              ),
              // Background symbol if enabled
              showSymbol && renderBackgroundSymbol()
            ] :
            // Without image layout
            [
              // Quote
              createElement(
                'div',
                { className: '  max-w-696 text-color-1' },
                quote
              ),
              // Author info
              createElement(
                'div',
                { className: 'space-y-2 max-lg:text-sm' },
                [
                  // Position
                  createElement(
                    'div',
                    { className: ' ' },
                    position
                  ),
                  // Name
                  createElement(
                    'div',
                    { className: 'text-color-1' },
                    name
                  )
                ]
              ),
              // Background symbol if enabled
              showSymbol && renderBackgroundSymbol()
            ]
        );
      },
    });
  })();