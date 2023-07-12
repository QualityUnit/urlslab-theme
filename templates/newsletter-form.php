<div class="Footer__newsletter--form" id="newsletter">
  <form onsubmit="subscribeNewsletter()" method="post" name="mc-embedded-subscribe-form" target="_blank">
    <input type="email" placeholder="Enter your e-mail for latest news" id="newsletter_input"
    class="Input" required />

    <button type="submit" name="subscribe" id="newsletter_submit" class="Button Button--full Button--dark" disabled>
      <span>Subscribe</span>
    </button>
  </form>
</div>
<!-- 
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

  const setMessage = ( message ) => {
    if ( message && Object.keys( message ).length ) {
      newsletter.insertAdjacentHTML( 'beforeend', `
      <div class="${message.status}">
        ${message.message}
      </div>
      `);
    }
  };

  const subscribeNewsletter = async (e) => {
    const subscribeVal = subscribeInput.value;
    let message;
    e.preventDefault();

    // 3. Send a request to our API with the user's email address.
    const res = await fetch('/api/subscribeAPI', {
      body: JSON.stringify({
        email: subscribeVal,
      }),
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'POST',
    });

    const { error } = await res.json();

    if (error) {
      // 4. If there was an error, update the message in state.
      message = { status: 'error', message: error };
      setMessage( message );
      return false;
    }

    // 5. Clear the input value and show a success message.
    subscribeVal = '';
    message = { status: 'success', message: 'Success! You are now subscribed to the newsletter.' };
    setMessage( message );
  };
</script> -->
