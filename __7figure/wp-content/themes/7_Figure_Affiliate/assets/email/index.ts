import 'dotenv/config';
import { Resend } from 'resend';

const resend = new Resend(process.env.RESEND_API_KEY);

(async function() {
  try {
    const data = await resend.emails.send({
      from: 'Tevis <success@7figure.affiliatemarketconnect.com>',
      to: ['tevisjohnston@gmail.com'],
      subject: 'Hello World',
      html: '<strong>It works!</strong>'
    });

    console.log(data);
  } catch (error) {
    console.error(error);
  }
})();