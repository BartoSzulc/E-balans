(function() {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const { 
    RichText, 
    InspectorControls, 
    useBlockProps,
    BlockControls,
    AlignmentToolbar
  } = wp.blockEditor;
  const { 
    PanelBody, 
    SelectControl, 
    ToggleControl,
    TextControl
  } = wp.components;
  const { createElement, Fragment } = wp.element;

  // Register the block
  registerBlockType('sage/wysiwyg', {
    apiVersion: 3,
    title: __('Edytor tekstu', 'sage'),
    description: __('Rozszerzony edytor tekstu z niestandardowymi opcjami stylizacji', 'sage'),
    category: 'sage-blocks',
    icon: 'edit',
    supports: {
      align: true,
      html: true,
      className: false, // Disable custom class name to prevent double styling
      anchor: false, // Disable default anchor to use our custom implementation
    },
    attributes: {
      content: {
        type: 'string',
        default: '',
      },
      textSize: {
        type: 'string',
        default: 'text-16',
      },
      textColor: {
        type: 'string',
        default: '',
      },
      tag: {
        type: 'string',
        default: 'p',
      },
      alignment: {
        type: 'string',
        default: 'left',
      },
      hasBullet: {
        type: 'boolean',
        default: false,
      },
      bulletColor: {
        type: 'string',
        default: '',
      },
      htmlAnchor: {
        type: 'string',
        default: '',
      }
    },
    
    edit: function(props) {
      const { attributes, setAttributes } = props;
      const { content, textSize, textColor, tag, alignment, hasBullet, bulletColor, htmlAnchor } = attributes;
      
      // Determine bullet class based on text size and tag
      const getBulletClass = () => {
        if (!hasBullet) return '';
        
        let bulletClass = 'bullet ';
        
        if (textSize === 'text-h4 lg:text-h3 mb-20' || tag === 'h2') {
          bulletClass += 'bullet-heading';
        } else if (textSize === '  mb-16' || tag === 'h3') {
          bulletClass += 'bullet-heading-small';
        } else if (textSize === 'text-18') {
          bulletClass += 'bullet-text';
        } else if (textSize === 'text-16' || textSize === '') {
          bulletClass += 'bullet-text--md';
        } else if (textSize === 'text-sm') {
          bulletClass += 'bullet-text--small';
        }
        
        if (bulletColor === 'purple') {
          bulletClass += ' bullet-purple';
        }
        
        return bulletClass;
      };
      
      // Generate classes for the text element
      const generateTextClasses = () => {
        let classes = [];
        
        if (textSize) classes.push(textSize);
        if (textColor) classes.push(textColor);
        if (alignment === 'center') classes.push('text-center');
        if (alignment === 'right') classes.push('text-right');
        
        const bulletClass = getBulletClass();
        if (bulletClass) classes.push(bulletClass);
        
        return classes.join(' ');
      };
      
      // Simple block props with ONLY the base class, no style-related classes
      const blockProps = useBlockProps({
        className: 'wysiwyg-block-container',
        id: htmlAnchor || undefined, // Add ID if present
      });
      
      // Available text sizes
      const textSizes = [
        { label: __('Domyślny', 'sage'), value: '' },
        { label: __('H2', 'sage'), value: 'text-h4 lg:text-h3 mb-20' },
        { label: __('H3', 'sage'), value: '  mb-16' },
        { label: __('Mały', 'sage'), value: 'text-sm' },
        { label: __('Średni', 'sage'), value: 'text-16' },
        { label: __('Duży', 'sage'), value: 'text-18' },
        { label: __('Bardzo duży', 'sage'), value: 'text-18' },
      ];
      
      // Available colors
      const textColors = [
        { label: __('Domyślny', 'sage'), value: '' },
        { label: __('Podstawowy 600', 'sage'), value: 'text-color-1600' },
        { label: __('Podstawowy 700', 'sage'), value: ' ' },
        { label: __('Podstawowy 900', 'sage'), value: 'text-color-1' },
        { label: __('Fioletowy 600', 'sage'), value: 'text-color-2' },
        { label: __('Fioletowy 900', 'sage'), value: 'text-color-2' },
      ];
      
      // Available HTML tags
      const htmlTags = [
        { label: __('Akapit', 'sage'), value: 'p' },
        { label: __('Nagłówek 1', 'sage'), value: 'h1' },
        { label: __('Nagłówek 2', 'sage'), value: 'h2' },
        { label: __('Nagłówek 3', 'sage'), value: 'h3' },
        { label: __('Nagłówek 4', 'sage'), value: 'h4' },
        { label: __('Nagłówek 5', 'sage'), value: 'h5' },
        { label: __('Nagłówek 6', 'sage'), value: 'h6' },
      ];
      
      // Available bullet colors
      const bulletColors = [
        { label: __('Domyślny', 'sage'), value: '' },
        { label: __('Fioletowy', 'sage'), value: 'purple' },
      ];
      
      return createElement(
        Fragment,
        {},
        [
          // Block Controls (toolbar)
          createElement(
            BlockControls,
            { key: 'block-controls' },
            [
              createElement(
                AlignmentToolbar,
                {
                  value: alignment,
                  onChange: (value) => {
                    setAttributes({ alignment: value || 'left' });
                  }
                }
              )
            ]
          ),
          
          // Inspector Controls (sidebar)
          createElement(
            InspectorControls,
            { key: 'inspector' },
            [
              createElement(
                PanelBody,
                { 
                  title: __('Ustawienia tekstu', 'sage'),
                  initialOpen: true
                },
                [
                  createElement(SelectControl, {
                    label: __('Tag HTML', 'sage'),
                    value: tag,
                    options: htmlTags,
                    onChange: (value) => {
                      setAttributes({ tag: value });
                    }
                  }),
                  createElement(SelectControl, {
                    label: __('Rozmiar tekstu', 'sage'),
                    value: textSize,
                    options: textSizes,
                    onChange: (value) => {
                      setAttributes({ textSize: value });
                    }
                  }),
                  createElement(SelectControl, {
                    label: __('Kolor tekstu', 'sage'),
                    value: textColor,
                    options: textColors,
                    onChange: (value) => {
                      setAttributes({ textColor: value });
                    }
                  }),
                  createElement(ToggleControl, {
                    label: __('Listowanie / Bullet?', 'sage'),
                    checked: hasBullet,
                    onChange: (value) => {
                      setAttributes({ hasBullet: value });
                    }
                  }),
                  hasBullet && createElement(SelectControl, {
                    label: __('Kolor bullet', 'sage'),
                    value: bulletColor,
                    options: bulletColors,
                    onChange: (value) => {
                      setAttributes({ bulletColor: value });
                    }
                  })
                ]
              ),
              createElement(
                PanelBody,
                { 
                  title: __('Kotwica HTML', 'sage'),
                  initialOpen: true
                },
                [
                  createElement(TextControl, {
                    label: __('ID kotwicy', 'sage'),
                    value: htmlAnchor,
                    onChange: (value) => {
                      // Format the ID - replace spaces with dashes and make lowercase
                      const formattedValue = value
                        .toLowerCase()
                        .replace(/[^a-z0-9-_]/g, '-')
                        .replace(/-+/g, '-') // Replace multiple dashes with a single dash
                        .replace(/^-|-$/g, ''); // Remove leading and trailing dashes
                        
                      setAttributes({ htmlAnchor: formattedValue });
                    },
                    help: __('Wprowadź ID, które będzie używane jako kotwica do nawigacji na stronie', 'sage')
                  })
                ]
              )
            ]
          ),
          
          // Content - Now with proper class separation
          createElement(
            'div',
            blockProps,
            createElement(
              RichText,
              {
                tagName: tag,
                value: content,
                onChange: (value) => {
                  setAttributes({ content: value });
                },
                placeholder: __('Wpisz swój tekst...', 'sage'),
                className: generateTextClasses(),
              }
            )
          )
        ]
      );
    },
    
    save: function(props) {
      const { attributes } = props;
      const { content, textSize, textColor, tag, alignment, hasBullet, bulletColor, htmlAnchor } = attributes;
      
      // Determine bullet class based on text size and tag
      const getBulletClass = () => {
        if (!hasBullet) return '';
        
        let bulletClass = 'bullet ';
        
        if (textSize === 'text-h4 lg:text-h3 mb-20' || tag === 'h2') {
          bulletClass += 'bullet-heading';
        } else if (textSize === '  mb-16' || tag === 'h3') {
          bulletClass += 'bullet-heading-small';
        } else if (textSize === 'text-18') {
          bulletClass += 'bullet-text';
        } else if (textSize === 'text-16' || textSize === '') {
          bulletClass += 'bullet-text--md';
        } else if (textSize === 'text-sm') {
          bulletClass += 'bullet-text--small';
        }
        
        if (bulletColor === 'purple') {
          bulletClass += ' bullet-purple';
        }
        
        return bulletClass;
      };
      
      // Generate classes for the text element
      const generateTextClasses = () => {
        let classes = [];
        
        if (textSize) classes.push(textSize);
        if (textColor) classes.push(textColor);
        if (alignment === 'center') classes.push('text-center');
        if (alignment === 'right') classes.push('text-right');
        
        const bulletClass = getBulletClass();
        if (bulletClass) classes.push(bulletClass);
        
        return classes.join(' ');
      };
      
      // Simple block props with just the base class
      const blockProps = useBlockProps.save({
        className: 'wysiwyg-block-container',
        id: htmlAnchor || undefined, // Add ID if present
      });
      
      return createElement(
        'div',
        blockProps,
        createElement(
          RichText.Content,
          {
            tagName: tag,
            value: content,
            className: generateTextClasses(),
          }
        )
      );
    },
  });
})();