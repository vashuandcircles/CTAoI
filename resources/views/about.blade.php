@include('partials.header')

<section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="banner_content text-center">
                <h2>About Us</h2>
                <div class="page_link">
                  <a href="{{ url('/') }}">Home</a>
                  <a href="{{ url('/about') }}">About Us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="about_area section_gap">
      <div class="container">
        <div class="row h_blog_item">
          <div class="col-lg-6">
            <div class="h_blog_img">
              <img class="img-fluid" src="img/about.png" alt="" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="h_blog_text">
              <div class="h_blog_text_inner left right">
                <h4>Welcome to CTAoI</h4>
                <p>
CTAoI is the leading provider of private tutoring. We are rapidly growing community that offers huge possibilities for your career advancement.
CTAoI has a mission to make world class coaching/home tuition, online tuition and e-tuition accessible and dedicated to fulfill dreams of education across India. 
We help find learning options for students as well as adults in academic and non academic area.
Greetings!!
                </p>
                <p>
                I personally welcome you to the CTAoI community. We will have more than 10000 plus students and 7000 plus tutors on-board and with you joining I hope that the community grows further strong.
My team is working hard to get you expert home tutors, online tutors or virtual tutors for academic, non academic and co-curricular courses. Our mission is to make world class coaching/home tutoring and 1 to 1 online tutoring accessible.
Meanwhile if you have any grievances or suggestion for improvement, I am all ears. Let me know by replying to teacher@ctaoi.com. <br>
<div style="text-align:right;">

Ashok Kumar<br>
Director, CTAoI<br>
</div>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@include('partials.footer')
