var imagesPreview = function(input, placeToInsertImagePreview) {

    if (input.files) {
        var filesAmount = input.files.length;

        for (var i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                var card = $('<div/>').attr({
                    class: 'col px-1 card border-0'
                })

                var divImage = $('<div/>').attr({
                    class: 'my-auto'
                })

                $($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'img-thumbnail imagePreview').appendTo(divImage);

                divImage.appendTo(card);

                var divFooter = $('<div/>').attr({
                    class: 'card-footer'
                })

                // buttonImage.appendTo(divFooter);
                divFooter.appendTo(card);
                card.appendTo(placeToInsertImagePreview);

                // if($('.imagePreview').length > 20){
                //     alert('Upload Gambar dibatasi hingga 10 gambar')
                //     return;
                // }
            }

            reader.readAsDataURL(input.files[i]);
        }
        }
    };

