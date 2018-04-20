### This is the config if lightbox should be globally used
[globalVar = LIT:1 = {$plugin.perfectlightbox.enableGlobally}]
    tt_content.image.20.1 {
        # Causes the usage of global ATagParams which contains the title of wrong images
        titleText.override.if.isTrue.field >

        # Use a more flexible title solution (use description and fallback to title or altText)
        imageLinkWrap {
            typolink {
                // Load FAL image and description
                parameter.override.cObject = IMG_RESOURCE
                parameter.override.cObject.file.import.data = file:current:uid
                parameter.override.cObject.file.treatIdAsReference = 1
                parameter.override.if.isTrue.field = image_zoom
                parameter.override.if.isFalse.field = image_link

                ATagParams.override.cObject = TEXT
                ATagParams.override.cObject.wrap = title="|"
                ATagParams.override.cObject.data = file:current:description // file:current:title // file:current:alternative
                ATagParams.override.if.isTrue.field = image_zoom
                ATagParams.override.if.isFalse.field = image_link
            }
        }
    }
[global]