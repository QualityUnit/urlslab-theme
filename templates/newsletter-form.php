<div class="Footer__newsletter--form" id="newsletter">
  <form action="https://qualityunit.us3.list-manage.com/subscribe/post?u=18d6ab6093f8e6cdbbd783635&amp;id=22b687a6cc&amp;f_id=00f6c2e1f0" method="post" name="mc-embedded-subscribe-form" target="_blank">
    <input type="email" name="EMAIL" placeholder="Enter your e-mail for latest news" id="newsletter_input"
    class="Input" required />
  <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_18d6ab6093f8e6cdbbd783635_22b687a6cc" tabindex="-1" value=""></div>

    <button type="submit" name="subscribe" id="newsletter_submit" class="Button Button--full Button--dark" disabled>
      <span>Subscribe</span>
    </button>

    <div id="mce-responses" class="clear">
      <div class="response" id="mce-error-response" style="display:none"></div>
      <div class="response" id="mce-success-response" style="display:none"></div>
    </div>
  </form>
</div>

<script type="text/javascript">
  const newsletter = document.querySelector('#newsletter');
  const emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
  const subscribeInput = document.querySelector('#newsletter_input');
  const subscribeBtn = document.querySelector('#newsletter_submit');
  
  subscribeInput.addEventListener( 'input', () => {
    const subscribeVal = subscribeInput.value;

    if ( ! emailRegex.test( subscribeVal ) ) {
      subscribeBtn.disabled = true;
      return false;
    }
    subscribeBtn.disabled = false;
  } );
</script>
