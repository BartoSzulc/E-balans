(function() {
    const { registerBlockType } = wp.blocks;
    const { __ } = wp.i18n;
    const { 
      MediaUpload, 
      MediaUploadCheck,
      InspectorControls, 
      useBlockProps 
    } = wp.blockEditor;
    const { 
      PanelBody, 
      Button,
      TextControl
    } = wp.components;
    const { createElement, Fragment } = wp.element;
  
    // Register the block
    registerBlockType('sage/image', {
      apiVersion: 3,
      title: __('Zdjęcie', 'sage'),
      description: __('Zdjęcie ze stylizowanymi ramkami', 'sage'),
      category: 'sage-blocks',
      icon: 'format-image',
      supports: {
        align: true,
        html: false,
        className: false, // Disable custom class name to prevent styling issues
      },
      attributes: {
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
        }
      },
      
      edit: function(props) {
        const { attributes, setAttributes } = props;
        const { imageUrl, imageId, imageAlt } = attributes;
        
        // Block props with the custom classes (editor version with square brackets)
        const blockProps = useBlockProps({
          className: 'w-full rounded-[12px] group max-lg:max-h-[510px] lg:h-[510px]',
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
                  title: __('Ustawienia zdjęcia', 'sage'),
                  initialOpen: true
                },
                [
                  createElement(TextControl, {
                    label: __('Tekst alternatywny', 'sage'),
                    value: imageAlt,
                    onChange: (value) => {
                      setAttributes({ imageAlt: value });
                    },
                    help: __('Opisz zawartość zdjęcia dla osób z niepełnosprawnościami', 'sage')
                  })
                ]
              )
            ),
            
            // Content
            createElement(
              'div',
              blockProps,
              !imageUrl ? 
                // If no image is selected, show the media upload button
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
                        return createElement(
                          Button,
                          {
                            className: 'w-full h-full flex items-center justify-center border-2 border-dashed border-gray-300 p-[12px] text-center',
                            onClick: open
                          },
                          __('Wybierz lub prześlij zdjęcie', 'sage')
                        );
                      }
                    }
                  )
                ) : 
                // If image is selected, show the image with edit button
                createElement(
                  Fragment,
                  {},
                  [
                    createElement(
                      'img',
                      {
                        src: imageUrl,
                        alt: imageAlt,
                        className: 'object-cover object-center size-full rounded-[12px]'
                      }
                    ),
                    createElement(
                      'div',
                      {
                        className: 'flex justify-end mt-2'
                      },
                      [
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
                                return createElement(
                                  Button,
                                  {
                                    onClick: open,
                                    variant: 'secondary',
                                    isSmall: true,
                                    className: 'mr-2'
                                  },
                                  __('Zmień zdjęcie', 'sage')
                                );
                              }
                            }
                          )
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
                )
            )
          ]
        );
      },
      
      save: function(props) {
        const { attributes } = props;
        const { imageUrl, imageAlt } = attributes;
        
        // No need to render anything if no image
        if (!imageUrl) {
          return null;
        }
        
        // Block props with the custom classes (frontend version without square brackets)
        const blockProps = useBlockProps.save({
          className: 'w-full rounded-12 group max-lg:max-h-510 lg:h-510',
        });
        
        return createElement(
          'div',
          blockProps,
          createElement(
            'img',
            {
              src: imageUrl,
              alt: imageAlt || '',
              className: 'object-cover object-center size-full rounded-12'
            }
          )
        );
      },
    });
  })();