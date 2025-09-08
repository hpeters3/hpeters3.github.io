import React from 'react'
import { projects } from '../data'
import { CodeIcon } from '@heroicons/react/solid'

//description, image

export default function Projects() {
  return (
    <section id="projects">
      <div className="px-5 py-10 text-center">
        <div className="mb-20">
          <CodeIcon className="inline-block w-10" />
          <h1 className="sm:text-4xl font-medium mb-4 text-white">
            Applications I've Built
          </h1>
          <p>
            The projects from my education that I'm the most proud of (with
            Parallel Reads being the top, especially because it's deployed).
          </p>
        </div>
        <div className="flex">
          {projects.map((project) => (
            <a href={project.link} key={project.image} className="sm:w-1/2 p-4">
              <div className="flex relative">
                <img
                  alt="gallery"
                  className="absolute h-full object-cover"
                  src={project.image}
                />
                <div className="px-3 py-10 z-10 border-4 border-gray-800 bg-gray-900 opacity-0 hover:opacity-100">
                  <h2
                    className="text-sm font-medium mb-1"
                    style={{ color: '#AD2831' }}
                  >
                    {project.subtitle}
                  </h2>
                  <h1 className="text-lg font-medium text-white">
                    {project.title}
                  </h1>
                  <p>{project.description}</p>
                </div>
              </div>
            </a>
          ))}
        </div>
      </div>
    </section>
  )
}
