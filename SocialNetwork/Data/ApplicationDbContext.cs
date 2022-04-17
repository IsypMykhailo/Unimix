using Microsoft.AspNetCore.Identity.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Text;

namespace SocialNetwork.Data
{
    public class ApplicationDbContext : IdentityDbContext<User>
    {
        public DbSet<Post> Posts { get; set; }
        public DbSet<Comment> Comments { get; set; }
        public DbSet<Like> Likes { get; set; }
        public DbSet<Image> Images { get; set; }
        public DbSet<Event> Events { get; set; }

        protected override void OnModelCreating(ModelBuilder builder)
        {
            base.OnModelCreating(builder);
            builder.Entity<User>()
                .Property(b => b.CreatedAt)
                .HasDefaultValueSql("getdate()");
            builder.Entity<Post>()
                .Property(b => b.CreatedAt)
                .HasDefaultValueSql("getdate()");
            builder.Entity<Comment>()
                .Property(b => b.CreatedAt)
                .HasDefaultValueSql("getdate()");
            builder.Entity<Like>()
                .Property(b => b.CreatedAt)
                .HasDefaultValueSql("getdate()");
            builder.Entity<User>()
                .Property(b => b.ImgUrl)
                .HasDefaultValueSql("'/storage/UserAvatars/avatar-none.png'");

            builder.Entity<User>()
                .Property(b => b.Background)
                .HasDefaultValueSql("'/storage/UserBackgrounds/default-background.png'");

            builder.Entity<User>()
                .HasMany(f=>f.Followers)
                .WithMany(f=>f.Following)
                .UsingEntity(j => j.ToTable("Follows"));

            builder.Entity<User>()
                .HasMany(f => f.Following)
                .WithMany(f => f.Followers)
                .UsingEntity(j => j.ToTable("Follows"));
        }
        public ApplicationDbContext() { }
        public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options)
            : base(options)
        {
        }
    }
}
