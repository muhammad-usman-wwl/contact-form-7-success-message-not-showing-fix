# Contact Form 7 — Success Message Not Showing & All Common Errors Fixed

Companion source code for the Simplified Dev Code Camp tutorial
**"Contact Form 7 Success Message Not Showing — All Common Errors Fixed"**.

Everything in this folder was used, live, in the video: the broken demo theme,
the fixed theme, and the demo "troublemaker" plugin that corrupts the form's
response. WordPress 7.1 · Contact Form 7 6.2.5 · PHP 8.3.

## What's inside

| Folder | What it is |
|---|---|
| `theme-broken/sdcc-cf7-demo/` | The demo theme as the video starts: `footer.php` never calls `wp_footer()`, so Contact Form 7's JavaScript is never printed. The form only submits with a full page reload. |
| `theme-fixed/sdcc-cf7-demo/` | The same theme after the fix: `wp_footer()` typed in before `</body>`. AJAX submit, spinner and the instant success message all work. **Diff the two `footer.php` files — that one block is the entire fix.** |
| `plugin-troublemaker/sdcc-debug-helper/` | A tiny demo plugin that stands in for any real plugin that leaves debug output on: it prints an HTML comment into CF7's REST API responses. The JSON becomes invalid, the browser throws the answer away, the email is sent — and the visitor sees **no success message**. Deactivate it and the form works instantly. |

## The three failures (and what each colour means)

Contact Form 7 answers every submission with one of three messages. The
colour tells you which stage failed:

1. **Orange — "One or more fields have an error. Please check and try again."**
   Validation stopped the submission. This is **not a bug** and no email was
   attempted. Read the tip under each field ("Please fill out this field.",
   "Please enter an email address.") — it names the exact problem.
   Fields marked `*` in the form editor are required.
2. **Red — "There was an error trying to send your message. Please try again later."**
   Validation passed, but **mail delivery failed**. On most local installs and
   much cheap hosting there is no mail server at all, so WordPress's default
   `mail()` has nothing to send through. Fix: send through SMTP instead
   (in the video: the free **WP Mail SMTP** plugin + a local **Mailpit**
   catcher on `127.0.0.1:1025`; on a live site use your provider's SMTP
   details). Always confirm with a test email that *arrives* — don't trust
   the green tick alone.
3. **No message at all — the success message never shows (but the email arrives).**
   The server answered, but the answer never made it into the page:
   - If the whole page **reloads** on submit, the form has no JavaScript:
     check that your theme calls `wp_head()` **and** `wp_footer()`. View the
     page source and search for `contact-form-7/includes/js` — if the script
     file isn't printed, CF7 can't run its AJAX submit or paint the response.
   - If the form spins and then shows **nothing**, open the browser
     **Console** (DevTools). A response corrupted by stray plugin output
     (debug text, PHP notices) is invalid JSON and gets thrown away. Find the
     culprit by **isolation**: deactivate plugins in halves until the form
     works — the last one off is the cause. Wrong reCAPTCHA keys confess in
     the same console.

## The 5-point checklist (from the video)

Run these in order — five minutes, catches every failure above:

1. **Update** — Is Contact Form 7 current? (Plugins page. Old plugin + new
   WordPress is a classic mismatch.)
2. **Footer scripts** — Does the page source contain the CF7 script file?
   (`contact-form-7/includes/js` — if not, your theme is missing `wp_footer()`.)
3. **Console** — Any red errors on the contact page? That's your
   plugin-conflict list, gift-wrapped.
4. **Mail test** — Send a test email (WP Mail SMTP → Tools → Email Test) and
   confirm it **arrives** in a real inbox / catcher.
5. **Mail tab** — In the form's Mail settings: **To** is an inbox you
   actually read (never the visitor's `[your-email]` tag), **From** is an
   address on your own domain, and Reply-To uses `[your-email]`.

## Reproduce it yourself

1. Install the `theme-broken` theme and activate it; add a page containing
   `[contact-form-7 id="..." title="Contact form 1"]`.
2. Submit the form → full-page reload; with no mail server you'll get the
   red error.
3. Install WP Mail SMTP, point it at any SMTP server (Mailpit locally),
   send the Email Test, then submit again → success, but still reloading.
4. Swap in `theme-fixed` (or type the `wp_footer()` block yourself) →
   instant AJAX success message.
5. Activate `plugin-troublemaker` → submit: the email arrives, the success
   message never appears, and the browser console shows the error.
   Deactivate it → fixed.
