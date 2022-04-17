using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.Extensions.Logging;
using SocialNetwork.Data;
using SocialNetwork.Models;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;

namespace SocialNetwork.Controllers
{
    public class HomeController : Controller
    {
        private readonly ILogger<HomeController> _logger;
        private readonly ApplicationDbContext _context;

        public HomeController(ILogger<HomeController> logger, ApplicationDbContext context)
        {
            _logger = logger;
            _context = context;
        }

        [Authorize]
        public IActionResult Index()
        {
            return View();
        }

        public IActionResult Privacy()
        {
            return View();
        }
        public IActionResult Jwt()
        {
            return View();
        }

        public IActionResult Profile()
        {
            return View();
        }

        // GET: AdminPosts/Create
        public IActionResult CreatePost()
        {
            ViewData["AuthorId"] = new SelectList(_context.Users, "Id", "UserName");
            return View();
        }

        // POST: AdminPosts/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> CreatePost([Bind("Id,Description,CreatedAt,AuthorId")] Post post)
        {
            if (ModelState.IsValid)
            {
                post.Id = Guid.NewGuid();
                _context.Add(post);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(CreateImage));
            }
            ViewData["AuthorId"] = new SelectList(_context.Users, "Id", "UserName", post.AuthorId);
            return View(post);
        }

        // GET: AdminImages/Create
        public IActionResult CreateImage()
        {
            var postsList = from p in _context.Posts
                            orderby p.CreatedAt descending
                            select p;
            ViewData["PostId"] = new SelectList(postsList, "Id", "Description");
            return View();
        }

        // POST: AdminImages/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> CreateImage([Bind("Id,ImgUrl,PostId")] Image image, IFormFile fileToStorage)
        {
            if (ModelState.IsValid)
            {
                image.Id = Guid.NewGuid();
                image.ImgUrl = await Helpers.Media.UploadImage(fileToStorage, "images");
                _context.Add(image);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Profile));
            }
            var postsList = from p in _context.Posts
                            orderby p.CreatedAt descending
                            select p;
            ViewData["PostId"] = new SelectList(postsList, "Id", "Description", image.PostId);
            return View(image);
        }

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
