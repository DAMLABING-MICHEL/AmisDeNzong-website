<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(function() {

        $.fn.filemanager = function(type, options) {
          type = type || 'file';

          this.on('click', function(e) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
            var target_input = $('#' + $(this).data('input'));
            var target_preview = $('#' + $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
              var file_path = items.map(function (item) {
                return item.url;
              }).join(',');
              // set the value of the desired input to image url
              target_input.val('').val(file_path).trigger('change');

              // clear previous preview
              target_preview.html('');

              // set or change the preview image src
              items.forEach(function (item) {
                target_preview.append(
                  $('<img>').attr('src', item.thumb_url)
                );
              });

              // trigger change event
              target_preview.trigger('change');
            };
            return false;
          });
        }

        $('#lfm').filemanager('image');

        $('#slug').keyup(function () {
          $(this).val(getSlug($(this).val()))
        })

        $('#title_en').keyup(function () {
          $('#slug').val(getSlug($(this).val()))
        })
   
        $('form').submit(function (event) {
            if ($(this).hasClass('submitted')) {
                event.preventDefault();
            }
            else {
                $(this).find(':submit').html('<i class="fa fa-spinner fa-spin"></i>');
                $(this).addClass('submitted');
                document.getElementById("submit").disabled = true;
            }
        });  
    
    })
      CKEDITOR.replace('content_en', { customConfig: '{{ asset('js/ckeditor.js') }}' });
      CKEDITOR.replace('content_fr', { customConfig: '{{ asset('js/ckeditor.js') }}' });
      CKEDITOR.replace('content_it', { customConfig: '{{ asset('js/ckeditor.js') }}' });
      CKEDITOR.replace('summary_en', { customConfig: '{{ asset('js/ckeditor.js') }}' });
      CKEDITOR.replace('summary_fr', { customConfig: '{{ asset('js/ckeditor.js') }}' });
      CKEDITOR.replace('summary_it', { customConfig: '{{ asset('js/ckeditor.js') }}' });
</script>