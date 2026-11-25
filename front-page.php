<?php
/**
 * Homepage template. Static content for now; swap sections for blocks/ACF/Woo queries as the site firms up.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main">

	<section class="hero">
		<div class="container hero__inner">
			<div class="hero__copy">
				<p class="eyebrow eyebrow--accent">For counselors short of a license</p>
				<h1 class="hero__title">Short a few courses for your counseling license?</h1>
				<p class="hero__lede">Find out exactly what you’re missing. We compare your transcript with your state’s rules, then match you with graduate courses from Partner University that close the gap.</p>
				<div class="hero__actions">
					<a class="btn" href="#check">Start your free 2-minute check</a>
					<a class="btn btn--ghost" href="#states">See your state’s rules</a>
				</div>
			</div>

			<div class="gap-report" role="figure" aria-label="Sample gap report">
				<div class="gap-report__head">
					<h2 class="gap-report__title">Sample gap report</h2>
					<p class="gap-report__meta">Illinois · LPC</p>
				</div>
				<p class="gap-report__degree">M.Ed. in school counseling, 2016 · 48 semester hours</p>
				<div class="gap-report__progress">
					<div class="gap-report__row"><b>Hours</b><span>48 of 60</span></div>
					<div class="progress" aria-hidden="true"><div class="progress__bar" style="width: 80%"></div></div>
				</div>
				<div class="gap-report__areas">
					<p class="gap-report__areas-label">Missing core areas</p>
					<div class="chips">
						<span class="chip">Psychopathology</span>
						<span class="chip">Substance abuse</span>
						<span class="chip">Family dynamics</span>
					</div>
				</div>
				<div class="gap-report__foot">
					<p class="gap-report__plan">Plan: 4 courses, 12 credits</p>
					<p class="gap-report__partner">Partner University</p>
				</div>
			</div>
		</div>
	</section>

	<section class="alert-band">
		<div class="container">
			<a class="alert-link" href="#">
				<span class="alert-link__text"><b>Illinois now requires 60 hours.</b> What that means if you have 48.</span>
				<span class="alert-link__cta">Read the Illinois page</span>
			</a>
		</div>
	</section>

	<section id="situations" class="section">
		<div class="container stack-32">
			<div class="section-head">
				<p class="eyebrow">Your situation</p>
				<h2 class="section-title">Which one are you?</h2>
			</div>
			<div class="card-row">
				<a class="card" href="#">
					<h3 class="card__title">School counselor moving to a clinical license</h3>
					<p class="card__text">Your school counseling degree may be a few clinical courses and hours short of an LPC.</p>
					<p class="card__cta">See your path</p>
				</a>
				<a class="card" href="#">
					<h3 class="card__title">Degree in a related field</h3>
					<p class="card__text">Counseling psychology, rehab or human services. Many states let you fill the missing areas with graduate courses.</p>
					<p class="card__cta">See your path</p>
				</a>
				<a class="card" href="#">
					<h3 class="card__title">Caught by a 48-to-60-hour change</h3>
					<p class="card__text">Your state raised its minimum before you got licensed. Often 12 hours closes the gap.</p>
					<p class="card__cta">See your path</p>
				</a>
				<a class="card" href="#">
					<h3 class="card__title">Moving to a new state</h3>
					<p class="card__text">Licensed already, but your new state’s rules differ. We check what it will ask for.</p>
					<p class="card__cta">See your path</p>
				</a>
			</div>
		</div>
	</section>

	<section id="how" class="section">
		<div class="container stack-28">
			<div class="section-head">
				<p class="eyebrow">How it works</p>
				<h2 class="section-title">Four steps, prices up front</h2>
			</div>
			<ol class="steps">
				<li class="step">
					<p class="step__label">Step 1 · Free</p>
					<h3 class="step__title">2-minute check</h3>
					<p class="step__text">Tell us your degree, hours, year and state. We tell you if a top-up is likely.</p>
				</li>
				<li class="step">
					<p class="step__label">Step 2 · $79</p>
					<h3 class="step__title">Transcript evaluation</h3>
					<p class="step__text">A written gap report: hours short, missing content areas and a course plan.</p>
				</li>
				<li class="step">
					<p class="step__label">Step 3</p>
					<h3 class="step__title">Take your courses</h3>
					<p class="step__text">Enroll with Partner University. The university admits you and teaches the courses.</p>
				</li>
				<li class="step">
					<p class="step__label">Step 4</p>
					<h3 class="step__title">Apply for your license</h3>
					<p class="step__text">We walk you through your state’s application and exam registration.</p>
				</li>
			</ol>
		</div>
	</section>

	<section id="states" class="section">
		<div class="container stack-28">
			<div class="states__head">
				<div class="section-head">
					<p class="eyebrow">State rules</p>
					<h2 class="section-title">Can you top up in your state?</h2>
				</div>
				<div class="field">
					<label for="state-select">Choose your state</label>
					<select id="state-select">
						<option>Illinois</option>
						<option>Texas</option>
						<option>Minnesota</option>
						<option>Tennessee</option>
						<option>Indiana</option>
						<option>Florida</option>
					</select>
				</div>
			</div>
			<div class="card-row">
				<div class="status-card">
					<h3 class="status-card__title">Top-ups allowed</h3>
					<p class="status-card__list"><a href="#">Illinois</a> · Texas · Minnesota · Tennessee · Indiana · Maryland · Oklahoma · Arizona · Oregon · Kentucky · Connecticut</p>
				</div>
				<div class="status-card status-card--caution">
					<h3 class="status-card__title">Allowed with conditions</h3>
					<p class="status-card__list">California · New York · Pennsylvania · Massachusetts · Michigan · Colorado</p>
				</div>
				<div class="status-card status-card--stop">
					<h3 class="status-card__title">Degree must already qualify</h3>
					<p class="status-card__list">Florida · North Carolina · Ohio · Alabama</p>
				</div>
			</div>
			<p class="fineprint">[VERIFY EACH STATE WITH ITS LICENSING BOARD BEFORE LAUNCH] · <a href="#">See all 50 states</a></p>
		</div>
	</section>

	<section id="partner" class="section">
		<div class="container">
			<div class="partner">
				<div class="partner__copy">
					<div class="partner__brand">
						<div class="partner__mark" aria-hidden="true">PU</div>
						<p class="eyebrow eyebrow--sand">Our university partner</p>
					</div>
					<h2 class="partner__title">Courses from Partner University</h2>
					<p class="partner__text">Regionally accredited graduate counseling courses, open to non-degree students and taken online. Partner University admits every student and issues the transcript.</p>
					<a class="partner__link" href="#">Why these credits count</a>
				</div>
				<div class="course-list">
					<div class="course-list__row"><p class="course-list__name">Psychopathology and diagnosis</p><p class="course-list__credits">3 credits</p></div>
					<div class="course-list__row"><p class="course-list__name">Substance abuse counseling</p><p class="course-list__credits">3 credits</p></div>
					<div class="course-list__row"><p class="course-list__name">Family counseling</p><p class="course-list__credits">3 credits</p></div>
					<div class="course-list__row course-list__row--meta"><p class="course-list__name">Price per credit</p><p class="course-list__credits">[PRICE PER CREDIT]</p></div>
				</div>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container trust">
			<div class="trust__item">
				<h3 class="trust__title">Reviewed by a person</h3>
				<p class="trust__text">Every evaluation is checked by a trained reviewer before you see it.</p>
			</div>
			<div class="trust__item">
				<h3 class="trust__title">Honest answers</h3>
				<p class="trust__text">If your state won’t accept a top-up, we tell you, and [REFUND POLICY].</p>
			</div>
			<div class="trust__item">
				<h3 class="trust__title">Your board decides</h3>
				<p class="trust__text">We show you what the rules say. Your state licensing board makes the final call.</p>
			</div>
		</div>
	</section>

	<section id="check" class="section">
		<div class="container">
			<div class="cta-band">
				<div class="cta-band__copy">
					<h2 class="cta-band__title">Find out what you’re missing in 2 minutes</h2>
					<p class="cta-band__text">Free, no transcript needed for the first check.</p>
				</div>
				<a class="btn btn--lg" href="#">Start my free check</a>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container faq">
			<div class="faq__intro">
				<p class="eyebrow">Questions</p>
				<h2 class="section-title">Common questions</h2>
			</div>
			<div class="faq__list">
				<div class="faq__item">
					<h3 class="faq__q">Are you a university?</h3>
					<p class="faq__a">No. We’re an independent advisory service. Your courses come from Partner University, which admits you and issues your transcript.</p>
				</div>
				<div class="faq__item">
					<h3 class="faq__q">What does the $79 evaluation include?</h3>
					<p class="faq__a">A written gap report: how many hours you’re short, which content areas are missing, and a course plan that closes the gap.</p>
				</div>
				<div class="faq__item">
					<h3 class="faq__q">Do continuing education (CE) courses count?</h3>
					<p class="faq__a">In most states, no. Top-up hours must be graduate coursework. Your state page says what counts.</p>
				</div>
				<div class="faq__item">
					<h3 class="faq__q">Do these courses guarantee my license?</h3>
					<p class="faq__a">No one can promise that. Your state board decides. We make sure you know exactly what its rules ask for.</p>
				</div>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
