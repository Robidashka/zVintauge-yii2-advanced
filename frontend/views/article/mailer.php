<center><button class="subscribe" data-trigger><a class="log-sig inline">Subscribe</a> <p class="inline">to mailing list?</p></button></center>

<div class="modal-container">
	<div class="modal-content">
		<button class="close">x</button>
		<h1>Enter your desired mail to send</h1>
		<?php $form = \yii\widgets\ActiveForm::begin(['action'=>['article/mailer', 'slug'=>$article->slug]])?>
        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($mailer, 'email')->textInput(['class'=>'form-control','placeholder'=>'Enter your email'])->label(false)?>
            </div>
        </div>
        <center><button type="submit" class="com-btn">I want newsletter</button></center>
        <?php \yii\widgets\ActiveForm::end();?>
	</div>
</div>

<script>
    (function(){
    var modal = document.querySelector('.modal-container');
    var closeButton = document.querySelector('.close');
    var modalTriggers = document.querySelectorAll('[data-trigger]');
  
    var isModalOpen = false;
    var pageYOffset = 0;
  
    var openModal = function() {
      pageYOffset = window.pageYOffset;
      modal.classList.add('is-open');
      isModalOpen = true;
    }
  
    var closeModal = function() {
      modal.classList.remove('is-open');
      isModalOpen = false;
    }
  
    var onScroll = function(e) {
      if (isModalOpen) {
        e.preventDefault();
        window.scrollTo(0, pageYOffset);
      }
    }
  
    modalTriggers.forEach(function(item) { 
      item.addEventListener('click', openModal);
    })
  
    document.addEventListener('scroll', onScroll);
  
    closeButton.addEventListener('click', closeModal);
    })();
</script>