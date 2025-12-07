(function() {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const { 
    InnerBlocks, 
    InspectorControls, 
    useBlockProps 
  } = wp.blockEditor;
  const { 
    PanelBody, 
    SelectControl,
    ToggleControl
  } = wp.components;
  const { createElement, Fragment } = wp.element;

  // Register the block
  registerBlockType('sage/text-group', {
    apiVersion: 3,
    title: __('Grupa tekstowa', 'sage'),
    description: __('Grupa elementów tekstowych z regulowanym odstępem', 'sage'),
    category: 'sage-blocks',
    icon: 'editor-paragraph',
    supports: {
      align: true,
      html: true,
    },
    attributes: {
      spacing: {
        type: 'string',
        default: 'space-y-12',
      },
      bgColor: {
        type: 'string',
        default: '', // Empty for no background
      },
      showSymbol: {
        type: 'boolean',
        default: true,
      }
    },
    
    edit: function(props) {
      const { attributes, setAttributes } = props;
      const { spacing, bgColor, showSymbol } = attributes;
      
      // Generate classes based on attributes
      const generateClasses = () => {
        let classes = ['text-group-block'];
        
        // Add spacing class regardless of background
        classes.push(spacing);
        
        // For the editor, use bracket syntax for arbitrary values
        if (bgColor) {
          if (bgColor === 'gray') {
            classes.push('relative overflow-hidden rounded-[12px] testimonial px-[24px] py-[32px] lg:p-[40px] bg-color-2 text-color-1');
          } else if (bgColor === 'purple') {
            classes.push('relative overflow-hidden rounded-[12px] testimonial px-[24px] py-[32px] lg:p-[40px]   text-color-2');
          }
        }
        
        return classes.join(' ');
      };
      
      const blockProps = useBlockProps({
        className: generateClasses(),
      });
      
      // Create the background decoration SVG element
      const renderBackgroundSymbol = () => {
        if (!bgColor || !showSymbol) return null;
        
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
      
      // Available spacing options
      const spacingOptions = [
        { label: __('Mały (12px)', 'sage'), value: 'space-y-12' },
        { label: __('Średni (16px)', 'sage'), value: 'space-y-16' },
        { label: __('Duży (24px / 32px)', 'sage'), value: 'space-y-24 lg:space-y-32' },
      ];
      
      // Background color options
      const bgColorOptions = [
        { label: __('Brak', 'sage'), value: '' },
        { label: __('Szary', 'sage'), value: 'gray' },
        { label: __('Fioletowy', 'sage'), value: 'purple' },
      ];
      
      // Only allow certain blocks
      const ALLOWED_BLOCKS = ['sage/wysiwyg', 'core/paragraph', 'core/heading', 'core/list'];
      
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
                title: __('Ustawienia bloku', 'sage'),
                initialOpen: true
              },
              [
                createElement(SelectControl, {
                  label: __('Odstęp między elementami', 'sage'),
                  value: spacing,
                  options: spacingOptions,
                  onChange: (value) => {
                    setAttributes({ spacing: value });
                  }
                }),
                createElement(SelectControl, {
                  label: __('Kolor tła', 'sage'),
                  value: bgColor,
                  options: bgColorOptions,
                  onChange: (value) => {
                    setAttributes({ bgColor: value });
                  }
                }),
                bgColor && createElement(ToggleControl, {
                  label: __('Pokaż symbol', 'sage'),
                  checked: showSymbol,
                  onChange: (value) => {
                    setAttributes({ showSymbol: value });
                  }
                })
              ]
            )
          ),
          
          // Content
          createElement(
            'div',
            blockProps,
            [
              // Add the background decoration if a background color is selected
              bgColor && showSymbol && renderBackgroundSymbol(),
              
              // InnerBlocks for content
              createElement(
                InnerBlocks,
                {
                  allowedBlocks: ALLOWED_BLOCKS,
                  template: [
                    ['sage/wysiwyg', {}],
                    ['sage/wysiwyg', {}]
                  ],
                  templateLock: false,
                }
              )
            ]
          )
        ]
      );
    },
    
    save: function(props) {
      const { attributes } = props;
      const { spacing, bgColor, showSymbol } = attributes;
      
      // Generate classes for saved content - without brackets for frontend
      const generateClasses = () => {
        let classes = ['text-group-block'];
        
        // Add spacing class regardless of background
        classes.push(spacing);
        
        // For the frontend, use classes without brackets
        if (bgColor) {
          if (bgColor === 'gray') {
            classes.push('relative overflow-hidden rounded-12 testimonial px-24 py-32 lg:p-40 bg-color-2 text-color-1');
          } else if (bgColor === 'purple') {
            classes.push('relative overflow-hidden rounded-12 testimonial px-24 py-32 lg:p-40   text-color-2');
          }
        }
        
        return classes.join(' ');
      };
      
      const blockProps = useBlockProps.save({
        className: generateClasses(),
      });
      
      // Create the background decoration SVG element for frontend
      const renderBackgroundSymbol = () => {
        if (!bgColor || !showSymbol) return null;
        
        return createElement(
          'div',
          {
            className: 'absolute -right-496 lg:-right-62 lg:top-24 w-735 h-400'
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
        [
          // Add the background decoration if a background color is selected
          bgColor && showSymbol && renderBackgroundSymbol(),
          
          // InnerBlocks Content
          createElement(
            InnerBlocks.Content,
            {}
          )
        ]
      );
    },
  });
})();