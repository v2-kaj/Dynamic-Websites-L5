
-- Create the movies table
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    release_year INT,
    genre VARCHAR(100),
);

-- Add the movies to the table
INSERT INTO movies (title, description, release_year, genre) VALUES
('Inception', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.', 2010, 'Sci-Fi'),
('The Shawshank Redemption', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 1994, 'Drama'),
('The Godfather', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 1972, 'Crime'),
('Pulp Fiction', 'The lives of two mob hitmen, a boxer, a gangster, and his wife intertwine in four tales of violence and redemption.', 1994, 'Crime'),
('The Dark Knight', 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.', 2008, 'Action');